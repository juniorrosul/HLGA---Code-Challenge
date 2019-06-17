<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# HostGator Latin America - Code Challenge | v0.1.0

This is a challenge code application. The main objective is create a PHP Web API that consults the Cat API: ​`https://docs.thecatapi.com`.

## Constraints 
   
   1. Use the RESTful standard;
   2. Use the proper HTTP verbs and statuses;
   3. It must be a PHP composer application;
   4. The PHP version should be 7 or above;
   5. There is no need to worry about pagination;
   6. The API must be public (no need to worry about authentication);
   7. Feel free to use any third-party library;
   8. The project must be on Github;
   9. If you find any blocker while solving the challenge, feel free to apply any solution you find  necessary to complete it 

## Using the API

All API documentation are available at: `[example.com]/docs`. But can be showed below:

- `GET [example.com]/breeds/?name=sib`
    - Search all breeds starting with query string `name`
- `GET [example.com]/breeds/?name=sib&experimental=true`
    - Search all breeds starting with query string `name`
    - `experimental` query string bring breeds with this tag
- `GET [example.com]/breeds/?name=sib&page=1`
    - Search all breeds starting with query string `name`
    - Return paginated object, if query string `page` is available.
- `GET [example.com]/breeds/{breedID}`
    - Search a local breed with exact `breed_id`

## Configurations

### Initial configuration

This application was built on [Laravel framework](https://laravel.com). For first run some configurations are needed:

- Copy `.env.example` to `.env`;
- Make all changes on `.env` file with your configurations;
- Run `composer install`;
- Run `php artisan key:generate`;

This will make your application ready to run on develop or production environment.

Running the application on different environments:

- NGINX
    ```
    server {
    	listen 80 default_server;
    
    	server_name example.com www.example.com;
    
    	access_log /srv/www/example.com/logs/access.log;
    	error_log /srv/www/example.com/logs/error.log;
    
    	root /srv/www/example.com/public;
    	index index.php index.html;
    
    	# serve static files directly
    	location ~* \.(jpg|jpeg|gif|css|png|js|ico|html)$ {
    		access_log off;
    		expires max;
    		log_not_found off;
    	}
    
    	# removes trailing slashes (prevents SEO duplicate content issues)
    	if (!-d $request_filename)
    	{
    		rewrite ^/(.+)/$ /$1 permanent;
    	}
    
    	# enforce NO www
    	if ($host ~* ^www\.(.*))
    	{
    		set $host_without_www $1;
    		rewrite ^/(.*)$ $scheme://$host_without_www/$1 permanent;
    	}
    
    	# unless the request is for a valid file (image, js, css, etc.), send to bootstrap
    	if (!-e $request_filename)
    	{
    		rewrite ^/(.*)$ /index.php?/$1 last;
    		break;
    	}
    
    	location / {
    		try_files $uri $uri/ /index.php?$query_string;
    	}
    
    	location ~* \.php$ {
    		try_files $uri = 404;
    		fastcgi_split_path_info ^(.+\.php)(/.+)$;
    		fastcgi_pass unix:/var/run/php5-fpm.sock; # may also be: 127.0.0.1:9000;
    		fastcgi_index index.php;
    		fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    		include fastcgi_params;
    	}
    
    	location ~ /\.ht {
    		deny all;
    	}
    }
    ```
- APACHE

    ```
    <VirtualHost *:80>
      ServerName sample.test
      DocumentRoot /var/www/sample/public/
      Options Indexes FollowSymLinks
    
      <Directory "/var/www/sample/public/">
        AllowOverride All
        <IfVersion < 2.4>
          Allow from all
        </IfVersion>
        <IfVersion >= 2.4>
          Require all granted
        </IfVersion>
      </Directory>
    
    </VirtualHost>
    ```
- PHP local server
    ```
    php artisan serve
    ``` 

### Generate/Regenerate API documentation

Run CLI command on root folder: `php artisan apidoc:generate`. 

> Running application using `php artisan serve` or `php -S 127.0.0.1` documentation will not display properly, its necessary to update manually the assets on `public\docs\index.html` 

### Generate API for 3th party CatAPI

Access https://thecatapi.com and follow the guide line.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
