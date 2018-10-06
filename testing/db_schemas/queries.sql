/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  GianBros
 * Created: 5/09/2018
 */

/*Índice en la tabla grupos_mat_prof 05/09/18 */
ALTER TABLE `eva_pec`.`grupos_mat_prof` ADD INDEX (`banco_materia_id`, `user_profesor_id`, `grupo_info_id`);
ALTER TABLE `grupos_mat_prof` ADD FOREIGN KEY (`banco_materia_id`) REFERENCES `banco_materias`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `grupos_mat_prof` ADD FOREIGN KEY (`grupo_info_id`) REFERENCES `grupos_info`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `grupos_mat_prof` ADD FOREIGN KEY (`user_profesor_id`) REFERENCES `usuarios`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

/*Campos nulos en la tabla usuario para añadir alumno, solo con usuario y perfil*/
ALTER TABLE `usuarios` CHANGE `user` `user` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `pass` `pass` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `clave` `clave` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `informacion_id` `informacion_id` INT(11) NULL;
ALTER TABLE `usuarios` CHANGE `user` `user` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `grupos_alumnos` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
/*Crear índices */
ALTER TABLE `grupos_alumnos` ADD FOREIGN KEY (`grupo_info_id`) REFERENCES `eva_pec`.`grupos_info`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `grupos_alumnos` ADD FOREIGN KEY (`user_alumno_id`) REFERENCES `eva_pec`.`usuarios`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

/*Cambios para tablas de rubricas*/
/*Se añade periodo_info_id a la tabla grupos_info, cada grupo va relacionado con el periodo (ciclo) */
ALTER TABLE `grupos_info` ADD `periodo_info_id` INT NOT NULL AFTER `plan_estudios_id`;
/* Llaves foraneas */
ALTER TABLE `periodo_info` ADD FOREIGN KEY (`estado_id`) REFERENCES `eva_pec`.`estados`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `periodo_fecha` ADD FOREIGN KEY (`periodo_info_id`) REFERENCES `eva_pec`.`periodo_info`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `rubrica_info` ADD FOREIGN KEY (`grupo_mat_prof_id`) REFERENCES `eva_pec`.`grupos_mat_prof`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `rubrica_info` ADD FOREIGN KEY (`periodo_fecha_id`) REFERENCES `eva_pec`.`periodo_fecha`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `rubrica_info` ADD FOREIGN KEY (`estado_id`) REFERENCES `eva_pec`.`estados`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `rubrica_info_calif` ADD FOREIGN KEY (`rubrica_info_id`) REFERENCES `eva_pec`.`rubrica_info`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
/*Falto el código de la llave foranea de rubrica_info_calif*/
ALTER TABLE `rubrica_detalles_calif` ADD FOREIGN KEY (`user_alumno_id`) REFERENCES `eva_pec`.`usuarios`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `grupos_info` ADD FOREIGN KEY (`periodo_info_id`) REFERENCES `eva_pec`.`periodo_info`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
