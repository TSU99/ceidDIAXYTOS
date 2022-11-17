
CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `location` varchar(80) NOT NULL,
  `IsAdmin` BOOLEAN NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `users` (`uid`, `username`, `name`, `password`,`location`,`IsAdmin`) VALUES
(1, 'test', 'emanouil giannopoulos', '12345','office1',TRUE),
(2, 'test1', 'marika metaxa', '12345','office1',FALSE),
(3, 'test2', 'panos papaioannou', '12345','office2',FALSE),
(4, 'test3', 'enri ajazi', '12345','office2',FALSE);
