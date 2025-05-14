<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PklResource\Pages;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Guru;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn; // Gunakan TextColumn untuk menampilkan tanggal
use Carbon\Carbon;


class PklResource extends Resource
{
    protected static ?string $model = Pkl::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    // Form untuk pendaftaran PKL
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Dropdown untuk memilih Siswa
                Forms\Components\Select::make('siswa_id')
                    ->label('Siswa')
                    ->options(Siswa::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),

                // Dropdown untuk memilih Industri
                Forms\Components\Select::make('industri_id')
                    ->label('Industri')
                    ->options(Industri::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),

                // Dropdown untuk memilih Guru Pendamping
                Forms\Components\Select::make('guru_id')
                    ->label('Guru Pendamping')
                    ->options(Guru::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),

                // Input untuk memilih tanggal mulai PKL
                Forms\Components\DatePicker::make('mulai')
                    ->label('Tanggal Mulai')
                    ->required(),

                // Input untuk memilih tanggal selesai PKL
                Forms\Components\DatePicker::make('selesai')
                    ->label('Tanggal Selesai')
                    ->required(),
            ]);
    }

    // Tabel untuk menampilkan data PKL
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Kolom untuk Nama Siswa
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Nama Siswa'),

                // Kolom untuk Nama Industri
                Tables\Columns\TextColumn::make('industri.nama')
                    ->label('Industri'),

                // Kolom untuk Nama Guru Pendamping
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru Pendamping'),

                // Gunakan TextColumn untuk Tanggal Mulai
                // Gunakan Carbon untuk memformat tanggal mulai dan selesai
                TextColumn::make('mulai')
                ->label('Tanggal Mulai')
                ->getStateUsing(fn($record) => $record->mulai ? Carbon::parse($record->mulai)->format('Y-m-d') : null),

                // Gunakan TextColumn untuk Tanggal Selesai
                TextColumn::make('selesai')
                ->label('Tanggal Selesai')
                ->getStateUsing(fn($record) => $record->selesai ? Carbon::parse($record->selesai)->format('Y-m-d') : null),

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

    // Menentukan halaman untuk resource ini
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPkls::route('/'),
            'create' => Pages\CreatePkl::route('/create'),
            'edit' => Pages\EditPkl::route('/{record}/edit'),
        ];
    }
}
