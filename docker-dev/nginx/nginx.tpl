server {
    listen %HTTP_PORT%;

    %SSL_CERTIFICATE%
    %SSL_KEY%
    %SSL_CA%
    root /var/www/public;

    %SERVER_NAME% 

    index index.html index.htm index.php;

    charset utf-8;

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    client_max_body_size 500m;
    sendfile off;

    #Requests limit
    limit_req zone=peroneip burst=550;
    
    #Connections limit
    limit_conn perip 10000;

    include       mime.types;
    default_type  application/octet-stream;

    gzip_vary on;

    #php params
    fastcgi_param magic_quotes_gpc "off";
    fastcgi_param magic_quotes_runtime "off";
    fastcgi_param register_globals "off";
    fastcgi_param short_open_tags "on";

    disable_symlinks "off";

    location = /nginx_status {
        stub_status;
    }

    location ~* ^/(.*/)?\.svn/ {
        return 403;
    }

    # Static files location
    location ~*^.+\.(jpg|jpeg|gif|png|css|zip|bmp|js|svg|ttf|eot|woff|xml|webp|txt|html|mp4|pdf|xls|xlsx|rtf|doc|docx)$
    {
        expires 25920000s; # 3 days
        access_log off;
        log_not_found off;
        add_header Pragma public;
        add_header Cache-Control "max-age=25920000, public";
    }

    location / {

        if ($https = '') {
            %SET_HTTP_PROTOCOL_REDIRECT%    rewrite ^(.*)$ https://$http_host$request_uri redirect;
        }

        if ($http_host ~* "^www\.(.*)") {
            rewrite ^(.*)$ http://%1/$1 redirect;
        }
    }

    location ~ ^.*\.php$ {
        fastcgi_pass php:9000;
        fastcgi_send_timeout 300;
        fastcgi_read_timeout 300;
        fastcgi_keep_conn on;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }

    location ~* ^(.*)$ {
        rewrite ^(.*)$ /index.php?$args last;
    }

    location /swagger-ui {
        location ~ \.(yaml)$ {

        }
        return 403;
    }

    location /.well-known {
        location ~ \.(json)$ {

        }
        return 403;
    }
}
