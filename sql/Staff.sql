CREATE TABLE Faculty (
    AcademicStaffID int PRIMARY KEY AUTO_INCREMENT,
    UserName varchar(50) NOT NULL,
    Password varchar(50) NOT NULL,
    ContactNumber varchar(20) NOT NULL,
    EmailAddress varchar(50) NOT NULL,
    FirstName varchar(50) NOT NULL,
    LastName varchar(50) NOT NULL,
    IsAdmin boolean NOT NULL DEFAULT false,
    DateCreated date NOT NULL DEFAULT CURRENT_TIMESTAMP
);
