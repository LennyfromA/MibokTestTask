CREATE DATABASE database_name;

CREATE TABLE `cart` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `product_id` int(11) NOT NULL,
                        `quantity` int(11) NOT NULL,
                        `session_id` varchar(255) NOT NULL,
                        PRIMARY KEY (`id`),
                        KEY `product_id` (`product_id`),
                        CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categories` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `name` varchar(50) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` VALUES (1,'Laptops'),(2,'Monitors'),(3,'Keyboards');

CREATE TABLE `products` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `category_id` int(11) DEFAULT NULL,
                            `name` varchar(100) NOT NULL,
                            `price` decimal(10,2) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `category_id` (`category_id`),
                            CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `products` VALUES (1,1,'Echips',25.00),(2,1,'Katana',80.00),(3,1,'TUF',90.00),(4,2,'Acer',50.00),(5,2,'Dexp',55.00),(6,2,'Xiaomi',60.00),(7,3,'ExeGate',20.00),(8,3,'Defender',30.00),(9,3,'Aceline',40.00);
