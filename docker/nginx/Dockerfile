FROM nginx:1.17.3-alpine

COPY docker/nginx/fastcgi_params /etc/nginx/fastcgi_params
COPY docker/nginx/mime.types /etc/nginx/mime.types
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf

COPY ./app /app