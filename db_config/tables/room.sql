CREATE TABLE IF NOT EXISTS room(
    room_no INTEGER(5) NOT NULL,
    building_id INTEGER(3) NOT NULL,
    faculty_id CHAR(2) NOT NULL,
    room_type VARCHAR(20),
    seat_capacity INTEGER(4),
    CONSTRAINT room_pk PRIMARY KEY (room_no, building_id, faculty_id),
    CONSTRAINT room_fk FOREIGN KEY (building_id, faculty_id) REFERENCES building(building_id, faculty_id)
);
