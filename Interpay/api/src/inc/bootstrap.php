<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');
header('content-type: application/json; charset=utf-8');

const ROOT_API_PATH = __DIR__ . '/../';

// Includes
require_once ROOT_API_PATH . '/inc/config.php';
require_once ROOT_API_PATH . '/inc/helpers.php';
require_once ROOT_API_PATH . '/inc/connection.php';

// Controllers
require_once ROOT_API_PATH . '/controllers/routesController.php';
require_once ROOT_API_PATH . '/controllers/searchController.php';
require_once ROOT_API_PATH . '/controllers/repositoryController.php';
require_once ROOT_API_PATH . '/controllers/mainController.php';

// Models
require_once ROOT_API_PATH . '/models/repositoryModel.php';
require_once ROOT_API_PATH . '/models/authorClass.php';
require_once ROOT_API_PATH . '/models/bookClass.php';

// Entity
require_once ROOT_API_PATH . '/entities/authorEntity.php';
require_once ROOT_API_PATH . '/entities/bookEntity.php';
