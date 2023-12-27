CREATE TABLE users (
    userid VARCHAR(255) PRIMARY KEY,
    fullname VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    pass VARCHAR(255),
    isadmin BOOLEAN,
    addresses TEXT,
    phone VARCHAR(20),
    residentialstate VARCHAR(255),
    country VARCHAR(255),
    dob DATE
);

CREATE TABLE booking (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tracking VARCHAR(255),
    receivername VARCHAR(255),
    receiveremail VARCHAR(255),
    receiveraddress VARCHAR(255),
    receiverpostal VARCHAR(255),
    senderid INT,
    quantity INT,
    weigh DECIMAL(10, 2),
    bookingdate DATE,
    expecteddate DATE,
    instructions TEXT,
    lat DECIMAL(10, 8),
    lng DECIMAL(11, 8),
    currentlocation TEXT,
    detail1 TEXT,
    detail2 TEXT,
    detail3 TEXT,
    detail4 TEXT,
    detail5 TEXT,
    detail6 TEXT,
    paymentstatus VARCHAR(50),
    FOREIGN KEY (senderid) REFERENCES users(userid)
);

CREATE TABLE chats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sender INT,
    receiver INT,
    messages TEXT,
    FOREIGN KEY (sender) REFERENCES users(userid),
    FOREIGN KEY (receiver) REFERENCES users(userid)
);
