/* Load data in to table Insurance */
LOAD DATA LOCAL INFILE "insurance.csv"
INTO TABLE Insurance
FIELDS TERMINATED BY ",";

/* Load data in to table Employee */
LOAD DATA LOCAL INFILE "employee.csv"
INTO TABLE Employee
FIELDS TERMINATED BY ",";

/* Load data in to table Applicant */
LOAD DATA LOCAL INFILE "applicant.csv"
INTO TABLE Applicant
FIELDS TERMINATED BY ",";

/* Load data in to table Policy */
LOAD DATA LOCAL INFILE "policy.csv"
INTO TABLE Policy
FIELDS TERMINATED BY ",";

/* Load data in to table Indemnity */
LOAD DATA LOCAL INFILE "indemnity.csv"
INTO TABLE Indemnity
FIELDS TERMINATED BY ",";



