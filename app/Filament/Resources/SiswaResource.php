<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;






class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('nama')
                    ->label('Nama Siswa')
                    ->required(),

                Forms\Components\TextInput::make('nis')
                    ->label('NIS')
                    ->required(),

                Forms\Components\Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat')
                    ->required(),

                Forms\Components\TextInput::make('kontak')
                    ->label('Kontak')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email(),

                Forms\Components\Toggle::make('status_pkl')
                    ->label('Status PKL')
                    ->default(false)
                    ->required(),

                //  // Menggunakan FileUpload untuk foto siswa
                // Forms\Components\FileUpload::make('foto')
                // ->label('Foto')
                // ->image()
                // // ->imagePreviewHeight(100)
                // // ->maxSize(1024) // maksimal 1MB
                // // ->disk('public')
                // ->directory('siswa_photos')
                // // ->preserveFilenames()
                // ->visibility('public')
                // ->required() // atau ->nullable() jika tidak wajib
                // ->columnSpanFull()
                // ->preview(),

                // FileUpload::make('foto')
                //     ->label('Foto')
                //     ->image()  // Mengizinkan hanya file gambar
                //     ->directory('siswa_photos')  // Folder tempat foto disimpan
                //     ->disk('public')  // Menyimpan di disk public
                //     ->visibility('public')  // Pastikan file tersedia secara publik
                //     ->maxSize(1024)  // Maksimal ukuran file 1MB
                //     ->required(),  // Jika foto wajib

                
                Forms\Components\FileUpload::make('foto')
                ->label('Foto')
                ->image()
                ->disk('public') // ini wajib!
                ->directory('fotosiswa')
                ->preserveFilenames()
                ->visibility('public')
                ->columnSpanFull()
                ->required(),
                // ijjj
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                // Menampilkan gambar (Foto)
                Tables\Columns\ImageColumn::make('foto')
                ->label('Foto')
                ->disk('public')
                ->circular()
                ->visibility('public')
                ->height(40),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Siswa'),

                Tables\Columns\TextColumn::make('nis')
                    ->label('NIS'),
                // Tables\Columns\TextColumn::make('guru.nama')
                //     ->label('Guru Pendamping'),
                // Tables\Columns\TextColumn::make('industri.nama')
                //     ->label('Industri'),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Jenis Kelamin'),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat'),
                Tables\Columns\TextColumn::make('kontak')
                    ->label('Kontak'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\BooleanColumn::make('status_pkl')
                    ->label('Status PKL')
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
