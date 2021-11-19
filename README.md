## Desafio Voalle

### Instalação

```
git clone https://github.com/MarceloSantosCorrea/desafio-voalle
cd desafio-voalle

cp .enx.example .env
php artisan key:generate
```

### Ajustar SMTP para email

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contato@voalle.com.br
MAIL_FROM_NAME="${APP_NAME}"
```

### Utilizando Docker

```
./vendor/bin/sail up -d
./vendor/bin/sail shell
php artisan migrate

url de acesso http://localhost
```

### Usando Servidor PHP

```
Configurar Conexão com Banco de Dados

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

php artisan serve

url de acesso [http://localhost:8000](http://localhost:8000).
```

#### Criar o primeiro usuário

```
http://localhost/register
```
