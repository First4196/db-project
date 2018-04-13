CREATE TABLE IF NOT EXISTS room(
    room_no VARCHAR(10) NOT NULL,
    building_id CHAR(4) NOT NULL,
    room_type VARCHAR(20),
    seat_capacity INTEGER(4),
    CONSTRAINT room_pk PRIMARY KEY (room_no, building_id),
    CONSTRAINT room_fk FOREIGN KEY (building_id) REFERENCES building(building_id)
);
