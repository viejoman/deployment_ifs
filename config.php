<?php

    //echo $_SERVER["SERVER_NAME"];

	if ( $_SERVER["SERVER_NAME"] == "localhost"){
		// Esto es por que en mi localhost la direccion es:
		// http://dannegm/www/blogs/
		define("domain", $_SERVER['SERVER_NAME']);
		define("db_server", "localhost");
		define("db_user", "root");
		define("db_password", "AkuMal2701");
		define("db_bdata", "ifsmexico");
	}else{
		define("domain", $_SERVER['SERVER_NAME']);
		define("db_server", "localhost");
		define("db_user", "ifsmexic");
		define("db_password", "4jrE_MX5O4bYcgBB5");
		define("db_bdata", "ifsmexico");
	}

	//Base de datos
	define("tb_itinerarios", "itinerarios");
	define("tb_users", "users");
    define("tb_tipocambio", "tipocambio");
    define("tb_oficina", "oficina");
    define("tb_empleado", "empleado");
    define("tb_puesto", "puesto");

?>