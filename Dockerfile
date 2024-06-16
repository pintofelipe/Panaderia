FROM bitnami/laravel:latest

WORKDIR /app

COPY composer.json composer.lock package.json package-lock.json ./

RUN composer install --download-only
RUN npm install

ENV DB_DATABASE /db/panaderia.sqlite
ENV DB_CONNECTION sqlite

RUN mkdir /db
RUN echo '.save /db/panaderia.sqlite' | sqlite3
RUN sqlite3 /db/panaderia.sqlite

COPY . .
RUN composer install

RUN npm run build

RUN php artisan migrate

EXPOSE 8000
