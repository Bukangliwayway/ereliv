CREATE TABLE Faculty (
  facultyID INT PRIMARY KEY AUTO_INCREMENT,
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  emailadd VARCHAR(255) UNIQUE NOT NULL,
  status ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
  dateregistered DATE NOT NULL DEFAULT CURRENT_DATE,
  code VARCHAR(255),
  category ENUM('Supervisor', 'Advisor') NOT NULL DEFAULT 'Advisor'
);

CREATE TABLE Student (
  studentID INT PRIMARY KEY AUTO_INCREMENT,
  studentnumber VARCHAR(255) UNIQUE NOT NULL,
  program VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  section VARCHAR(255) NOT NULL,
  emailadd VARCHAR(255) UNIQUE NOT NULL,
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  status ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Inactive',
  advisor INT NOT NULL,
  dateregistered DATE NOT NULL DEFAULT CURRENT_DATE,
  code VARCHAR(255),
  FOREIGN KEY (advisor) REFERENCES Faculty(facultyID)
);

CREATE TABLE Admin (
    adminID INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE Research (
    researchID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    abstract TEXT NOT NULL,
    datepublished DATE NOT NULL,
    keywords VARCHAR(255) NOT NULL,
    status ENUM('Published', 'Unpublished') NOT NULL DEFAULT 'Unpublished',
    proposer VARCHAR(255) NOT NULL
);

CREATE TABLE Notification (
    notificationID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    dateissued DATE NOT NULL,
    redirect VARCHAR(255) NOT NULL,
    status ENUM('Read', 'Unread') NOT NULL DEFAULT 'Unread',
    facultyRecipientID INT,
    studentRecipientID INT,
    facultyIssuerID INT,
    studentIssuerID INT,
    FOREIGN KEY (facultyRecipientID) REFERENCES Faculty(facultyID),
    FOREIGN KEY (studentRecipientID) REFERENCES Student(studentID),
    FOREIGN KEY (facultyIssuerID) REFERENCES Faculty(facultyID),
    FOREIGN KEY (studentIssuerID) REFERENCES Student(studentID)
);

CREATE TABLE Author (
    authorID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL
);

CREATE TABLE Section (
    sectionID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE Program (
  programID INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL
);

CREATE TABLE Programsections (
  programID INT NOT NULL,
  sectionID INT NOT NULL,
  PRIMARY KEY (programID, sectionID),
  FOREIGN KEY (programID) REFERENCES Program(programID),
  FOREIGN KEY (sectionID) REFERENCES Section(sectionID)
);

CREATE TABLE Adviserteam (
  facultyID INT NOT NULL,
  studentID INT NOT NULL,
  PRIMARY KEY (facultyID, studentID),
  CONSTRAINT fk_adviserteam_faculty FOREIGN KEY (facultyID) REFERENCES Faculty(facultyID),
  CONSTRAINT fk_adviserteam_student FOREIGN KEY (studentID) REFERENCES Student(studentID)
);

CREATE TABLE Researchprogramlist (
  researchID INT NOT NULL,
  programID INT NOT NULL,
  PRIMARY KEY (researchID, programID),
  FOREIGN KEY (researchID) REFERENCES Research(researchID),
  FOREIGN KEY (programID) REFERENCES Program(programID)
);

CREATE TABLE Researcheditaccess (
  researchID INT NOT NULL,
  facultyID INT NOT NULL,
  PRIMARY KEY (researchID, facultyID),
  FOREIGN KEY (researchID) REFERENCES Research(researchID),
  FOREIGN KEY (facultyID) REFERENCES Faculty(facultyID)
);

CREATE TABLE Researchauthorlist (
  authorID INT NOT NULL,
  researchID INT NOT NULL,
  PRIMARY KEY (authorID, researchID),
  FOREIGN KEY (authorID) REFERENCES Author(authorID),
  FOREIGN KEY (researchID) REFERENCES Research(researchID)
);