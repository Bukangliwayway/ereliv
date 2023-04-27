CREATE TABLE Students (
  StudentID INT AUTO_INCREMENT PRIMARY KEY,
  StudentNumber VARCHAR(20) NOT NULL,
  Password VARCHAR(60) NOT NULL,
  Section VARCHAR(20) NOT NULL,
  EmailAddress VARCHAR(50) NOT NULL,
  FirstName VARCHAR(20) NOT NULL,
  LastName VARCHAR(20) NOT NULL,
  ApprovalStatus ENUM('Pending', 'Approved') NOT NULL DEFAULT 'Pending',
  Approver INT,
  DateRegistered DATE NOT NULL DEFAULT CURRENT_DATE,
  DateApproved DATE,
  CONSTRAINT fk_approver FOREIGN KEY (Approver) REFERENCES Staff(AcademicStaffID),
  INDEX(StudentNumber),
  UNIQUE(StudentNumber),
  UNIQUE(EmailAddress)
);
