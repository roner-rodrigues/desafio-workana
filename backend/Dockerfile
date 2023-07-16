# Use a imagem do PHP CLI como base
FROM php:8.1-cli

# Atualize o sistema e instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Copie os arquivos do aplicativo para o contêiner
COPY . /var/www/html/

# Exponha a porta 8080
EXPOSE 8080

# Inicie o servidor PHP embutido
CMD php -S 0.0.0.0:8080 -t /var/www/html/
