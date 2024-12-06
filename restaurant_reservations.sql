SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `restaurant_reservations`


-- Table structure for table `customers`


DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customerId` int NOT NULL AUTO_INCREMENT,
  `customerName` varchar(45) NOT NULL,
  `contactInfo` varchar(200) NOT NULL COMMENT 'email or phone number',
  PRIMARY KEY (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dumping data for table `customers`


INSERT INTO `customers` (`customerId`, `customerName`, `contactInfo`) VALUES
(1, 'Cindy', 'Cindy11@gmail.com'),
(2, 'Carlos', 'Carlos123@gmail.com'),
(3, 'Julio', '1234567890');


-- Table structure for table `diningpreferences`

DROP TABLE IF EXISTS `diningpreferences`;
CREATE TABLE IF NOT EXISTS `diningpreferences` (
  `preferenceId` int NOT NULL AUTO_INCREMENT,
  `customerId` int NOT NULL,
  `favoriteTable` varchar(45) NOT NULL,
  `dietaryRestrictions` varchar(200) NOT NULL,
  PRIMARY KEY (`preferenceId`),
  KEY `customerId` (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dumping data for table `diningpreferences`


INSERT INTO `diningpreferences` (`preferenceId`, `customerId`, `favoriteTable`, `dietaryRestrictions`) VALUES
(1, 1, 'My favorite table is 5th number table', 'Nothing to say about that'),
(2, 2, 'My favorite table is the window table', 'Lactose Intolerant'),
(5, 3, 'My favorite table is the corner number table', 'None');


-- Table structure for table `reservations`


DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `reservationId` int NOT NULL AUTO_INCREMENT,
  `customerId` int NOT NULL,
  `reservationTime` datetime NOT NULL,
  `numberOfGuests` int NOT NULL,
  `specialRequests` varchar(200) NOT NULL,
  PRIMARY KEY (`reservationId`),
  KEY `customerId` (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dumping data for table `reservations`


INSERT INTO `reservations` (`reservationId`, `customerId`, `reservationTime`, `numberOfGuests`, `specialRequests`) VALUES
(8, 1, '2024-11-30 19:33:00', 3, 'Dim lights'),
(12, 2, '2024-12-01 00:17:00', 4, 'None'),
(14, 3, '2024-12-01 13:54:00', 2, 'None');


-- Constraints for dumped tables


-- Constraints for table `diningpreferences`

ALTER TABLE `diningpreferences`
  ADD CONSTRAINT `diningpreferences_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
