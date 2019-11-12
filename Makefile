conf:
	sudo apt-get install libapache2-mod-php7.3 php7.3-cgi php7.3-cli php7.3-curl php7.3-imap php7.3-gd php7.3-mysql php7.3-pgsql php7.3-sqlite3 php7.3-mbstring php7.3-json php7.3-bz2 php7.3-xmlrpc php7.3-gmp php7.3-xsl php7.3-soap php7.3-xml php7.3-zip php7.3-dba
	composer install --no-scripts
	npm install
	npm run prod
	cp .env.example .env
	php artisan key:generate
	sudo apt-get install mysql-server-5.7
	$(MAKE) db-conf

db-conf:
	mysql -u root -p --execute="drop database if exists PSMSI; create database PSMSI; drop user if exists 'PSMSI'; create user 'PSMSI' identified by 'PSMSI'; grant all privileges on PSMSI.* to 'PSMSI';"
	sed -i 's/DB_DATABASE.*/DB_DATABASE=PSMSI/' .env
	sed -i 's/DB_USERNAME.*/DB_USERNAME=PSMSI/' .env
	sed -i 's/DB_PASSWORD.*/DB_PASSWORD=PSMSI/' .env
	php artisan migrate:refresh --seed
	php artisan serve
