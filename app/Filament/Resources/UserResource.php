<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Name Field
            TextInput::make('name')
            ->label('Name')
            ->placeholder('Name')
            ->required(),

        // Email Field
        TextInput::make('email')
            ->label('Email Address')
            ->placeholder('Email')
            ->email()
            ->required(),

        // Email Created At Field
        DateTimePicker::make('created_at')
            ->label('Email Created At')
            ->placeholder('Email Created At')
            ->default(now())
            ->disabled(), // Input cannot be edited

        // Password Field
        // TextInput::make('password')
        //     ->label('Password')
        //     ->placeholder('Password')
        //     ->required(),

         TextInput::make('password')
            ->password()
            ->maxLength(255)
            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
            ->required(fn (string $context) => $context === 'create') // ← hanya required saat create
            ->hidden(fn (string $context) => $context === 'edit') // opsional: sembunyikan di edit
            ->label('Password (Hanya saat membuat user)'),

        // Roles Field (Relation with spatie/permission)
        Select::make('roles')
            ->relationship('roles', 'name') // Relationship with roles from spatie/permission
            ->multiple()
            ->columnSpan(2)
            ->required(),
         ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            // Name Column
            TextColumn::make('name')
                ->searchable(),

            // Email Column
            TextColumn::make('email')
                ->searchable(),

            // Created At Column
            TextColumn::make('created_at')
                ->dateTime()
                ->searchable(),

            // Roles Column (nested relationship)
            TextColumn::make('roles.name')
                ->label('Roles')
                ->searchable(),
        ]);
    }

    public static function getNavigationSort(): int
{
    return 6;
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
