CREATE DATABASE login;

use login;
--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`member_id` int(8) NOT NULL,
  `member_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `member_password` varchar(64) NOT NULL,
  `member_email` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `member_password`, `member_email`) VALUES
(1, 'user', 'password', 'user@gmail.com');

--
-- Table structure for table `beers`
--

CREATE TABLE IF NOT EXISTS `beers` (
`beer_id` int(8) NOT NULL,
  `beer_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `volume` float NOT NULL,
  `original_gravity` float(255) NOT NULL,
  `final_gravity` float(255) NOT NULL,
  `ibus` float(255) NOT NULL,
  `bottles` int(8) NOT NULL,
  `drunk_bottles` int(8) NOT NULL,
  `color` int(8) NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19

--
-- Dumping data for table `beers`
--

INSERT INTO `members` (`beer_id`, `beer_name`, `volume`, `original_gravity`, `final_gravity`, `ibus`, `bottles`, `drunk_bottles`, `color`, `type`) VALUES
(1, 'sample_beer', '5', '1.060', '1.010', '30', '15', '0', '1', 'Pale Ale');