ALTER TABLE active_vehicles MODIFY driver_id INT(11) DEFAULT NULL COMMENT 'FOREIGN';
ALTER TABLE active_vehicles MODIFY route_id INT(11) DEFAULT NULL COMMENT 'FOREIGN';

ALTER TABLE mediaboxes ADD assigned_to INT(11) DEFAULT NULL COMMENT 'FOREIGN' AFTER box_tag;

ALTER TABLE ready_vehicles MODIFY box_id INT(11) DEFAULT NULL COMMENT 'FOREIGN';
ALTER TABLE ready_vehicles MODIFY tv_id INT(11) DEFAULT NULL COMMENT 'FOREIGN';

ALTER TABLE tvs ADD assigned_to INT(11) DEFAULT NULL COMMENT 'FOREIGN' AFTER tv_description;
ALTER TABLE vehicles ADD assigned_to INT(11) DEFAULT NULL COMMENT 'FOREIGN' AFTER vehicle_type;
