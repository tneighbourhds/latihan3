<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Siswa')
                    ->required(),

                TextInput::make('nis')
                    ->label('NIS')
                    ->required(),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),

                TextInput::make('alamat')
                    ->label('Alamat')
                    ->required(),

                TextInput::make('kontak')
                    ->label('Kontak')
                    ->tel()                     
                    ->placeholder('Masukkan nomor telepon')
                    ->minLength(10)
                    ->maxLength(15)
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),

                Toggle::make('status_pkl')
                    ->label('Status PKL')
                    ->default(false)
                    ->required(),

                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->disk('public')
                    ->directory('siswa_photos')
                    ->preserveFilenames()
                    ->visibility('public')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->height(40),

                TextColumn::make('nama')
                    ->label('Nama Siswa'),

                TextColumn::make('nis')
                    ->label('NIS'),

                TextColumn::make('gender')
                    ->label('Jenis Kelamin'),

                TextColumn::make('alamat')
                    ->label('Alamat'),

                TextColumn::make('kontak')
                    ->label('Kontak')
                    ->formatStateUsing(fn ($state) => $state),

                TextColumn::make('email')
                    ->label('Email'),

                BooleanColumn::make('status_pkl')
                    ->label('Status PKL')
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                // (bila Anda ingin menambahkan filter, tambahkan di sini)
            ])
            ->actions([
                // EditAction selalu muncul
                EditAction::make(),

                // DeleteAction single-row: 
                // - Hanya muncul bila siswa BELUM terdaftar PKL
                // - Jika ternyata terdaftar PKL, akan cancel dan munculkan notifikasi
                DeleteAction::make()
                    ->label('Hapus')
                    ->visible(fn (Siswa $record): bool => ! $record->pkls()->exists())
                    ->before(function (Siswa $record, array $data): bool {
                        if ($record->pkls()->exists()) {
                            Notification::make()
                                ->title('Gagal dihapus')
                                ->danger()
                                ->body("Siswa NIS {$record->nis} sudah terdaftar PKL, tidak dapat dihapus.")
                                ->send();
                            return false;
                        }
                        return true;
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('delete_selected')
                        ->label('Delete selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        // 1) Ambil semua record yang dipilih
                        // 2) Pisahkan mana yang boleh dihapus (status_pkl=false) 
                        //    dan mana yang harus di-skip (status_pkl=true)
                        // 3) Hanya panggil Siswa::destroy() untuk yang boleh dihapus
                        ->action(function (EloquentCollection $records) {
                            $canBeDeleted    = [];
                            $cannotBeDeleted = [];

                            /** @var \App\Models\Siswa $record */
                            foreach ($records as $record) {
                                if ($record->pkls()->exists()) {
                                    // Siswa aktif → skip
                                    $cannotBeDeleted[] = $record;
                                } else {
                                    // Siswa non-aktif → boleh dihapus
                                    $canBeDeleted[] = $record;
                                }
                            }

                            // Hapus hanya yang non-aktif
                            if (! empty($canBeDeleted)) {
                                $ids = array_map(fn ($s) => $s->id, $canBeDeleted);
                                Siswa::destroy($ids);
                            }

                            // Notifikasi hasil
                            if (! empty($canBeDeleted) && empty($cannotBeDeleted)) {
                                Notification::make()
                                    ->title('Berhasil')
                                    ->success()
                                    ->body(count($canBeDeleted) . ' siswa berhasil dihapus.')
                                    ->send();
                            } elseif (! empty($canBeDeleted) && ! empty($cannotBeDeleted)) {
                                $msg1 = count($canBeDeleted) . ' siswa berhasil dihapus.';
                                $msg2 = count($cannotBeDeleted) . ' siswa tidak dihapus karena sudah terdaftar PKL.';
                                Notification::make()
                                    ->title('Sebagian siswa dihapus')
                                    ->warning()
                                    ->body("{$msg1} {$msg2}")
                                    ->send();
                            } elseif (empty($canBeDeleted) && ! empty($cannotBeDeleted)) {
                                Notification::make()
                                    ->title('Gagal menghapus')
                                    ->danger()
                                    ->body(count($cannotBeDeleted) . ' siswa tidak dapat dihapus karena sudah terdaftar PKL.')
                                    ->send();
                            }
                        }),

                    // **Catatan penting: tidak ada lagi ->hidden(...)** 
                    // sehingga tombol "Delete selected" akan selalu tampil 
                    // meski ada siswa yang aktif di PKL.
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit'   => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
