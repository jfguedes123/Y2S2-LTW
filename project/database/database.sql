BEGIN TRANSACTION;
PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Department;
CREATE TABLE Department (
    department TEXT NOT NULL PRIMARY KEY UNIQUE 
);

DROP TABLE IF EXISTS User;
CREATE TABLE User (
    username TEXT NOT NULL PRIMARY KEY UNIQUE,
    name_ TEXT NOT NULL,
    pass TEXT NOT NULL,
    email TEXT NOT NULL,
    rank TEXT CHECK (rank = "client" or rank = "agent" or rank = "admin"),
    department Text REFERENCES Department (department)
);

DROP TABLE IF EXISTS Ticket;
CREATE TABLE Ticket (
    id INTEGER NOT NULL PRIMARY KEY UNIQUE,
    title TEXT NOT NULL,
    importance TEXT CHECK (importance = "low" or importance = "medium" or importance = "high"),
    stat TEXT CHECK (stat = "sent" or stat = "picked" or stat = "solved"),
    descript TEXT NOT NULL,
    time_ INTEGER NOT NULL,
    department TEXT REFERENCES Department (department),
    submitter TEXT REFERENCES User (username)
);

DROP TABLE IF EXISTS Hashtag;
CREATE TABLE Hashtag (
    tag TEXT NOT NULL PRIMARY KEY UNIQUE
);

DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
    ticket INTEGER REFERENCES Ticket (id),
    time_ INTEGER NOT NULL,
    sender TEXT REFERENCES USER (username),
    comment TEXT NOT NULL,
    PRIMARY KEY (ticket, time_)
);

DROP TABLE IF EXISTS Has;
CREATE TABLE Has (
    tag_ TEXT NOT NULL,
    ticket INTEGER NOT NULL,
    PRIMARY KEY (tag_, ticket),
    FOREIGN KEY (tag_) REFERENCES Hashtag (tag),
    FOREIGN KEY (ticket) REFERENCES Ticket (id)
);

DROP TABLE IF EXISTS Assigned;
CREATE TABLE Assigned (
    user TEXT NOT NULL,
    ticket INTEGER NOT NULL,
    PRIMARY KEY (user, ticket),
    FOREIGN KEY (user) REFERENCES User (username),
    FOREIGN KEY (ticket) REFERENCES Ticket (id)
);

DROP TABLE IF EXISTS Change;
CREATE TABLE Change (
    ticket INTEGER REFERENCES Ticket (id),
    time_ INTEGER NOT NULL,
    change TEXT NOT NULL,
    PRIMARY KEY (ticket, time_)
);

DROP TABLE IF EXISTS Faq;
CREATE TABLE Faq (
    id INTEGER NOT NULL PRIMARY KEY UNIQUE,
    question TEXT NOT NULL
); 

CREATE Trigger Upusername
    After Update Of username on User
    For Each Row
BEGIN
    UPDATE Assigned SET user = NEW.username WHERE user = OLD.username;
    UPDATE Comment SET sender = NEW.username WHERE sender = OLD.username;
    UPDATE Ticket SET submitter = NEW.username WHERE submitter = OLD.username;
End;

INSERT INTO Department (department) VALUES ('Engenharia Informática e Computação');
INSERT INTO Department (department) VALUES ('Engenharia Eletrotécnica e de Computadores');
INSERT INTO Department (department) VALUES ('Bioengenharia');
INSERT INTO Department (department) VALUES ('Engenharia de Materiais');
INSERT INTO Department (department) VALUES ('Engenharia e Gestão Industrial');


INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("LiamClark", "Liam Clark", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'liamclark@gmail.com', 'agent', 'Engenharia e Gestão Industrial');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("IsabellaThomas", "Isabella Thomas", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'isabellathomas@gmail.com', 'client', 'Engenharia e Gestão Industrial');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("NoahAdams", "Noah Adams", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'noahadams@gmail.com', 'client', 'Engenharia e Gestão Industrial');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("MiaRoberts", "Mia Roberts", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'miaroberts@gmail.com', 'client', 'Engenharia e Gestão Industrial');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("BenjaminWalker", "Benjamin Walker", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'benjaminwalker@gmail.com', 'agent', 'Engenharia e Gestão Industrial');

INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("JohnDoe", "John Doe", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'johndoe@gmail.com', 'agent', 'Engenharia Informática e Computação');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("JaneSmith", "Jane Smith", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'janesmith@gmail.com', 'client', 'Engenharia Informática e Computação');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("AlexBrown", "Alex Brown", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'alexbrown@gmail.com', 'agent', 'Engenharia Informática e Computação');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("EmilyJohnson", "Emily Johnson", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'emilyjohnson@gmail.com', 'client', 'Engenharia Informática e Computação');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("DavidLee", "David Lee", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'davidlee@gmail.com', 'client', 'Engenharia Informática e Computação');

INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("SophiaMiller", "Sophia Miller", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'sophiamiller@gmail.com', 'client', 'Bioengenharia');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("MichaelWilson", "Michael Wilson", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'michaelwilson@gmail.com', 'agent', 'Bioengenharia');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("OliviaDavis", "Olivia Davis", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'oliviadavis@gmail.com', 'client', 'Bioengenharia');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("WilliamTaylor", "William Taylor", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'williamtaylor@gmail.com', 'agent', 'Bioengenharia');
INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("AvaAnderson", "Ava Anderson", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'avaanderson@gmail.com', 'client', 'Bioengenharia');

INSERT INTO User (username, name_, pass, email, rank, department) VALUES ("Andre28", "André", '$2y$12$DT12W4gAcfMC1QyE8byOG.blSLOV/1g1/OGQfT6WAIChzEw2gFKau', 'teste', 'admin', 'Engenharia Informática e Computação');
INSERT INTO Ticket (id, title, importance, stat, descript, time_, department, submitter) VALUES (1, 'test ticket', 'low', 'sent', 'Hello? Teste!!! ahahah', 1, 'Engenharia Informática', 'Andre28');
INSERT INTO Assigned (user, ticket) VALUES ('Andre28', 2);

COMMIT TRANSACTION;
