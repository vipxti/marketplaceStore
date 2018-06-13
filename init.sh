#!/bin/bash

echo 'Instalando as dependências do projeto...'
echo '----------------------------------------'
echo ''
composer install
echo ''
echo 'Copiando arquivo env'
echo '----------------------------------------'
cp .env.example .env
echo ''
echo 'Gerando nova chave para o projeto'
echo '----------------------------------------'
echo ''
php artisan key:generate
echo ''
echo '----------------------------------------'
echo 'Instalando os módulos do Node.js...'
echo '----------------------------------------'
echo ''
npm install
echo ''
echo '----------------------------------------'
echo 'Compilando os arquivos css e javascript...'
echo '----------------------------------------'
echo ''
npm run dev
echo ''
echo 'Fim do script....'
