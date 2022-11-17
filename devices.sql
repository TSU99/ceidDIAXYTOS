CREATE TABLE `devices` (
  `DevID` int(11) NOT NULL,
  `location` varchar(80) NOT NULL,
  `type` varchar(80) NOT NULL,
  `speed` varchar(80) NOT NULL,
  `SetPoint` int(11) NOT NULL
  `LightBrightness` varchar(80) NOT NULL,
  `IsLighton` BOOLEAN NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `devices` (`DevID`, `location`,`type`, `speed`, `SetPoint`,`LightBrightness`,`IsLighton`) VALUES
(1, 'office1', 'light', '','',0,FALSE),
(2, 'office1', 'fan',  '50','',0,FALSE),
(3, 'office1', 'thermostat',  '','23',0,FALSE),
(4, 'office2', 'fan', '0','',0,FALSE);
