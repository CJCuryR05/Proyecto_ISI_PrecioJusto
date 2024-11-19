TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `after_product_insert` AFTER INSERT ON `productos` FOR EACH ROW BEGIN\n    DECLARE total_productos INT;\n    DECLARE total_precio DOUBLE;\n    DECLARE precio_moda DOUBLE;\n\n    -- Obtener el total de productos y el total de precios de la categoría\n    SELECT COUNT(*), SUM(precio_pesos) INTO total_productos, total_precio\n    FROM productos\n    WHERE nombrecategoria = NEW.nombrecategoria;\n\n    -- Calcular el promedio de precios\n    UPDATE categorias\n    SET preciopromedio = total_precio / total_productos\n    WHERE nombrecategoria = NEW.nombrecategoria;\n\n    -- Calcular la moda de precios\n    SELECT precio_pesos INTO precio_moda\n    FROM (\n        SELECT precio_pesos, COUNT(*) as frequency\n        FROM productos\n        WHERE nombrecategoria = NEW.nombrecategoria\n        GROUP BY precio_pesos\n        ORDER BY frequency DESC\n        LIMIT 1\n    ) as modaprecio;\n\n    -- Actualizar la moda de precios\n    UPDATE categorias\n    SET modaprecio = precio_moda\n    WHERE nombrecategoria = NEW.nombrecategoria;\nEND'
sql_modes=1098907648
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci'
created=1715704911923731
