DROP TABLE if exists Indemnity;
DROP TABLE IF EXISTS Policy;
DROP TABLE IF EXISTS Applicant;
DROP TABLE IF EXISTS Employee;
DROP TABLE IF EXISTS Insurance;



-- ----------------------------
--  Table structure for Employee
-- ----------------------------
CREATE TABLE Employee (
  Ee_id char(4)  NOT NULL, /* No two employees can share the same ID */
  Ee_name varchar(50) NOT NULL,
  Ee_pass char(6) NOT NULL,
  PRIMARY KEY(Ee_id)
) ;

-- ----------------------------
--  Table structure for Applicant
-- ----------------------------

CREATE TABLE Applicant (
  App_ssn char(9) NOT NULL,
  App_name varchar(40) NOT NULL,
  App_age int(3) NOT NULL,
  App_gender char(1) NOT NULL,
  App_career char(1) NOT NULL,
  Mgr_id char(4) NOT NULL,
  App_pass char(6) NOT NULL,
  PRIMARY KEY (App_ssn),
  FOREIGN KEY(Mgr_id) REFERENCES Employee(Ee_id)
);



-- ----------------------------
--  Table structure for Insurance
-- ----------------------------

CREATE TABLE Insurance (
  Ins_id char(4)  NOT NULL,
  Ins_name varchar(50) UNIQUE NOT NULL,
  Ins_type varchar(10) NOT NULL,
  Policy_period char(5) NOT NULL,
  Min_premium decimal(10,2) NOT NULL,
  Max_insured decimal(10,2) NOT NULL,
  PRIMARY KEY (Ins_id)
);

-- ----------------------------
--  Table structure for Policy
-- ----------------------------

CREATE TABLE Policy (
  Policy_no char(9) NOT NULL,
  App_ssn char(9) NOT NULL,
  Ins_id char(4) NOT NULL,
  Eff_date date NOT NULL,
  Real_premium decimal(10,2) DEFAULT 0,
  Real_insured decimal(10,2) DEFAULT 0,
  PRIMARY KEY (Policy_no),
  FOREIGN KEY (App_ssn) REFERENCES Applicant (App_ssn),
  FOREIGN KEY (Ins_id) REFERENCES Insurance (Ins_id)
);

-- ----------------------------
--  Table structure for Indemnity
-- ----------------------------

CREATE TABLE Indemnity (
	Indem_no char(9) NOT NULL,
	Policy_no char(9) NOT NULL,
	Indem_date date DEFAULT NULL,
	Real_benefit decimal(10,2) DEFAULT 0,
	PRIMARY KEY(Indem_no),
	FOREIGN KEY(Policy_no) REFERENCES Policy(Policy_no)
);


