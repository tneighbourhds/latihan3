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

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('guru_id')
                //     ->label('Guru Pendamping')
                //     ->options(Guru::all()->pluck('nama', 'id')) // Dropdown untuk memilih Guru
                //     ->searchable()
                //     ->required(),

                // Forms\Components\Select::make('industri_id')
                //     ->label('Industri')
                //     ->options(Industri::all()->pluck('nama', 'id')) // Dropdown untuk memilih Industri
                //     ->searchable()
                //     ->required(),

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
