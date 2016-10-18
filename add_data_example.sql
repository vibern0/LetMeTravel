INSERT INTO `stations`(`name`) VALUES('Braga');
INSERT INTO `stations`(`name`) VALUES('Porto');
INSERT INTO `stations`(`name`) VALUES('Coimbra');
INSERT INTO `stations`(`name`) VALUES('Lisboa');
INSERT INTO `stations`(`name`) VALUES('Beja');

INSERT INTO `stops`(`id_station`, `time`) VALUES(1, '10:00:00');
INSERT INTO `stops`(`id_station`, `time`) VALUES(2, '11:00:00');
INSERT INTO `stops`(`id_station`, `time`) VALUES(3, '13:00:00');
INSERT INTO `stops`(`id_station`, `time`) VALUES(4, '16:00:00');
INSERT INTO `stops`(`id_station`, `time`) VALUES(5, '18:00:00');

INSERT INTO `trajects`(`id`, `id_stop`, `order`) VALUES(1, 1, 0);
INSERT INTO `trajects`(`id`, `id_stop`, `order`) VALUES(1, 2, 1);
INSERT INTO `trajects`(`id`, `id_stop`, `order`) VALUES(1, 3, 2);
INSERT INTO `trajects`(`id`, `id_stop`, `order`) VALUES(1, 4, 3);
INSERT INTO `trajects`(`id`, `id_stop`, `order`) VALUES(1, 5, 4);

INSERT INTO `transports`(`id_traject`, `number`, `seats`) VALUES(1, 50, 64);

INSERT INTO `weekday`(`id_traject`, `week_day`) VALUES(1, 2);
INSERT INTO `weekday`(`id_traject`, `week_day`) VALUES(1, 4);
