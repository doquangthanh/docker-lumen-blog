FROM nginx:latest

LABEL Maintainer="Do Quang Thanh <thanhdoquang@live.com>"

ADD nginx.conf /etc/nginx/
ADD site.conf /etc/nginx/sites-available/

RUN echo "upstream php-upstream { server php-fpm:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 www-data

EXPOSE 80

CMD ["nginx"]
