
CREATE TABLE Users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    password VARCHAR(255),
    email VARCHAR(255),
    role VARCHAR(255),
    created_at DATETIME
);


CREATE TABLE Contacts (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    email VARCHAR(255),
    telephone VARCHAR(255),
    company VARCHAR(255),
    type VARCHAR(255),
    assigned_to INTEGER,
    created_by INTEGER,
    created_at DATETIME,
    updated_at DATETIME
);

INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('John', 'Brown', 'john.brown1@example.com', 'User', '2023-11-15 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Richard', 'Garcia', 'richard.garcia2@example.com', 'User', '2023-09-22 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('John', 'Martin', 'john.martin3@example.com', 'User', '2023-01-27 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Mary', 'Davis', 'mary.davis4@example.com', 'User', '2023-08-03 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Jessica', 'Gonzalez', 'jessica.gonzalez5@example.com', 'User', '2023-11-22 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Mary', 'Rodriguez', 'mary.rodriguez6@example.com', 'User', '2023-04-26 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Joseph', 'Gonzalez', 'joseph.gonzalez7@example.com', 'User', '2023-12-03 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('James', 'Garcia', 'james.garcia8@example.com', 'User', '2023-01-02 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Richard', 'Hernandez', 'richard.hernandez9@example.com', 'User', '2023-11-15 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Joseph', 'Jones', 'joseph.jones10@example.com', 'User', '2023-05-02 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Charles', 'Anderson', 'charles.anderson11@example.com', 'User', '2023-10-22 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Jennifer', 'Miller', 'jennifer.miller12@example.com', 'User', '2022-12-11 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('John', 'Jackson', 'john.jackson13@example.com', 'User', '2023-02-27 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Sarah', 'Jackson', 'sarah.jackson14@example.com', 'User', '2023-08-08 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Robert', 'Miller', 'robert.miller15@example.com', 'User', '2022-12-16 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Thomas', 'Miller', 'thomas.miller16@example.com', 'User', '2023-01-20 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Charles', 'Moore', 'charles.moore17@example.com', 'User', '2023-06-14 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Robert', 'Anderson', 'robert.anderson18@example.com', 'User', '2023-05-11 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('Susan', 'Martinez', 'susan.martinez19@example.com', 'User', '2023-06-27 04:32:02');
INSERT INTO Users (firstname, lastname, email, role, created_at) VALUES ('John', 'Taylor', 'john.taylor20@example.com', 'User', '2023-05-02 04:32:02');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Mrs.', 'John', 'Anderson', 'john.anderson1@business.com', '+1-555-4674', 'Innovatech', 'Support', 14, 14, '2023-02-22 04:39:28', '2023-02-22 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Prof.', 'Richard', 'Lopez', 'richard.lopez2@business.com', '+1-555-2999', 'Alpha Corp', 'Sales Lead', 7, 7, '2023-08-09 04:39:28', '2023-08-09 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Prof.', 'Linda', 'Brown', 'linda.brown3@business.com', '+1-555-5925', 'Beta Solutions', 'Sales Lead', 1, 1, '2023-07-07 04:39:28', '2023-07-07 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Dr.', 'John', 'Garcia', 'john.garcia4@business.com', '+1-555-2406', 'Beta Solutions', 'Support', 13, 13, '2023-02-21 04:39:28', '2023-02-21 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Dr.', 'John', 'Moore', 'john.moore5@business.com', '+1-555-7943', 'Beta Solutions', 'Sales Lead', 17, 17, '2023-02-27 04:39:28', '2023-02-27 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Dr.', 'James', 'Lopez', 'james.lopez6@business.com', '+1-555-5104', 'Beta Solutions', 'Sales Lead', 18, 18, '2023-09-28 04:39:28', '2023-09-28 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Mrs.', 'William', 'Wilson', 'william.wilson7@business.com', '+1-555-1400', 'Alpha Corp', 'Support', 19, 19, '2023-06-09 04:39:28', '2023-06-09 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Dr.', 'Linda', 'Moore', 'linda.moore8@business.com', '+1-555-9032', 'Innovatech', 'Sales Lead', 3, 3, '2023-05-09 04:39:28', '2023-05-09 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Dr.', 'Linda', 'Rodriguez', 'linda.rodriguez9@business.com', '+1-555-4994', 'Beta Solutions', 'Support', 11, 11, '2023-08-07 04:39:28', '2023-08-07 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Mrs.', 'Sarah', 'Wilson', 'sarah.wilson10@business.com', '+1-555-2750', 'Global Tech', 'Support', 20, 20, '2022-12-13 04:39:28', '2022-12-13 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Mrs.', 'Joseph', 'Hernandez', 'joseph.hernandez11@business.com', '+1-555-2365', 'Global Tech', 'Sales Lead', 6, 6, '2023-05-07 04:39:28', '2023-05-07 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Prof.', 'James', 'Lopez', 'james.lopez12@business.com', '+1-555-7974', 'Alpha Corp', 'Sales Lead', 8, 8, '2023-05-31 04:39:28', '2023-05-31 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Ms.', 'Michael', 'Gonzalez', 'michael.gonzalez13@business.com', '+1-555-4515', 'Innovatech', 'Sales Lead', 17, 17, '2023-03-26 04:39:28', '2023-03-26 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Dr.', 'Linda', 'Gonzalez', 'linda.gonzalez14@business.com', '+1-555-2690', 'Global Tech', 'Sales Lead', 4, 4, '2023-08-05 04:39:28', '2023-08-05 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Ms.', 'Barbara', 'Jackson', 'barbara.jackson15@business.com', '+1-555-7404', 'Global Tech', 'Support', 13, 13, '2023-08-18 04:39:28', '2023-08-18 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Mrs.', 'William', 'Smith', 'william.smith16@business.com', '+1-555-5911', 'Gamma Industries', 'Sales Lead', 9, 9, '2023-10-14 04:39:28', '2023-10-14 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Mrs.', 'Thomas', 'Lopez', 'thomas.lopez17@business.com', '+1-555-4381', 'Global Tech', 'Sales Lead', 14, 14, '2023-09-12 04:39:28', '2023-09-12 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Mrs.', 'David', 'Gonzalez', 'david.gonzalez18@business.com', '+1-555-7488', 'Gamma Industries', 'Support', 1, 1, '2023-05-13 04:39:28', '2023-05-13 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Mrs.', 'Susan', 'Wilson', 'susan.wilson19@business.com', '+1-555-6137', 'Beta Solutions', 'Support', 1, 1, '2023-01-28 04:39:28', '2023-01-28 04:39:28');
INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('Prof.', 'William', 'Rodriguez', 'william.rodriguez20@business.com', '+1-555-5023', 'Innovatech', 'Support', 18, 18, '2023-05-11 04:39:28', '2023-05-11 04:39:28');

INSERT INTO Users (firstname, lastname, password, email, role, created_at)
VALUES ('Admin', 'User', 'hashed_password_placeholder', 'admin@project2.com', 'Administrator', NOW());
