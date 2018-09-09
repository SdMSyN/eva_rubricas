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
