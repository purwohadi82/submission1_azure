 CODEIGNITER + BOOSTRAP + JQUERY + MYSQL
====================================================================== 

Panel de administrador de la muestra usando CodeIgniter 2.1.2 con Mysql y Twitter Bootstrap. 

<h2> Requerimientos </h2>
<ul>
<li>
<a href="http://twitter.github.com/bootstrap/" target="_blank">Bootstrap</a> 2.0.4+</li>
<li>
<a href="http://jquery.com/" target="_blank">jQuery</a> 1.7.1+</li>
</ul>


<h2> Funcionalidades: </h2> 

<ul> 
   <li> Registrarse / Iniciar sesión / Cerrar sesión </ li> 
   <li> Crear, insertar, editar y eliminar los productos </ li> 
   <li> Crear, insertar, editar y eliminar los fabricantes </ li> 
   <li> Todas las formas con la validación final de vuelta </ li> 
   contenido de los datos de lista <li> con paginación, búsqueda y filtros </ li> 
</ ul> 
-------------------------------------------------- ----------------

<h2>Screenshots</h2>

<img src="http://cl.ly/image/040F053a0v07/Screen%20Shot%202013-03-19%20at%203.35.55%20PM.png"/>

<img src="http://cl.ly/image/3o1I3i3z0C0F/Screen%20Shot%202013-03-19%20at%203.40.43%20PM.png"/>

<img src="http://cl.ly/image/3e0N0k1V0N3T/Screen%20Shot%202013-03-19%20at%204.10.06%20PM.png"/>

------------------------------------------------------------------

<h2> Instrucciones </h2> 

<ul> 
   Configurar <li> su base de datos en application / config / database.php </ li> 
   <li> Cambio $ config ['base_url'] en application / config / config.php </ li> 
   <li> Acceda a su url proyecto </ li> 
   <li> Regístrate y disfruta! </ li> 
</ ul>
------------------------------------------------------------------

<h2>Mysql Dump</h2>

```
CREATE TABLE `ci_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `manufacturers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(40) DEFAULT NULL,
  `stock` double DEFAULT NULL,
  `cost_price` double DEFAULT NULL,
  `sell_price` double DEFAULT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

```


