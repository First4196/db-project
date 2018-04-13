CREATE TABLE IF NOT EXISTS request(
    student_id VARCHAR(11) NOT NULL,
    request_time DATETIME NOT NULL,
    form_name VARCHAR(30),
    details VARCHAR(300),
    status ENUM('Accepted','Rejected','Pending'),
    CONSTRAINT request_pk PRIMARY KEY (student_id,request_time),
    CONSTRAINT request_fk FOREIGN KEY (student_id) REFERENCES student(student_id)
);
