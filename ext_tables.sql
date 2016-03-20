#
# Table structure for table 'Widget'
#
CREATE TABLE tx_mydashboard_domain_model_widget (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,

	be_user int(10) DEFAULT '0' NOT NULL,
	class_name text NOT NULL,
	x int(10) DEFAULT '0' NOT NULL,
	y int(10) DEFAULT '0' NOT NULL,
	configuration text NOT NULL,

	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid,deleted,hidden,sorting)
);

#
# Table structure for table 'be_users'
#
CREATE TABLE be_users (
	tx_mydashboard_config text NOT NULL,
	tx_mydashboard_widgets int(10) DEFAULT '0' NOT NULL,
);
