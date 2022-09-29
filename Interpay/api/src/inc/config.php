<?php

const DB_HOST = 'localhost';

const DB_USER = 'root';

const DB_PASS = 'toor';

const DB_NAME = 'bookstore';

const DB_PORT = '3306';

const DB_DSN = 'mysql:host=' . DB_HOST . '; port=' . DB_PORT . '; dbname=' . DB_NAME;

const DB_OPTIONS = 		[
	\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
	\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
	\PDO::ATTR_EMULATE_PREPARES => false,
	\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
];
