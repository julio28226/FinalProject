CREATE DATABASE restaurant_reservations;

USE restaurant_reservations;

CREATE TABLE Customers (
    customerId INT NOT NULL AUTO_INCREMENT,
    customerName VARCHAR(45) NOT NULL,
    contactInfo VARCHAR(200) NOT NULL,
    PRIMARY KEY (customerId)
);

CREATE TABLE Reservations (
    reservationId INT NOT NULL AUTO_INCREMENT,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests VARCHAR(200),
    PRIMARY KEY (reservationId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

CREATE TABLE DiningPreferences (
    preferenceId INT NOT NULL AUTO_INCREMENT,
    customerId INT NOT NULL,
    favoriteTable VARCHAR(45),
    dietaryRestrictions VARCHAR(200),
    PRIMARY KEY (preferenceId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

INSERT INTO Customers (customerName, contactInfo)
VALUES ('John Doe', 'john@example.com'),
       ('Jane Smith', 'jane@example.com'),
       ('Alice Johnson', 'alice@example.com');

INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
VALUES (1, '2024-11-30 19:00:00', 4, 'Window seat'),
       (2, '2024-12-01 20:00:00', 2, 'Vegetarian meal'),
       (3, '2024-12-02 18:30:00', 3, NULL);

INSERT INTO DiningPreferences (customerId, favoriteTable, dietaryRestrictions)
VALUES (1, 'Table 5', 'No nuts'),
       (2, 'Table 2', 'Vegan'),
       (3, 'Table 8', 'Gluten-free');
DELIMITER $$

CREATE PROCEDURE findReservations(IN customerId INT)
BEGIN
    SELECT * FROM Reservations WHERE customerId = customerId;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addSpecialRequest(IN reservationId INT, IN requests VARCHAR(200))
BEGIN
    UPDATE Reservations 
    SET specialRequests = requests 
    WHERE reservationId = reservationId;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addReservation(
    IN customerName VARCHAR(45),
    IN reservationTime DATETIME,
    IN numberOfGuests INT,
    IN specialRequests VARCHAR(200)
)
BEGIN
    DECLARE customerId INT;

    SELECT customerId INTO customerId FROM Customers WHERE customerName = customerName;

    IF customerId IS NULL THEN
        INSERT INTO Customers (customerName, contactInfo) VALUES (customerName, "Unknown");
        SET customerId = LAST_INSERT_ID();
    END IF;

    INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
    VALUES (customerId, reservationTime, numberOfGuests, specialRequests);
END $$

DELIMITER ;




