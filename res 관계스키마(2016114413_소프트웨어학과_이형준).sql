create table 부동산중개인 (
중개인번호 int primary key,
중개인이름 varchar(10) not null,
부동산중개횟수 int
);

create table 구매자 (
구매자번호 int primary key,
구매자이름 varchar(10) not null
);

create table 판매자 (
판매자번호 int primary key,
판매자이름 varchar(10) not null
);

create table 현재매물 (
매물번호 varchar(10) primary key,
판매자번호 int not null,
중개인번호 int not null,
건물사진 varchar(255) not null,
건물이름 varchar(50),
침실갯수 int not null,
화장실갯수 int not null,
도시 varchar(10) not null,
판매가 int not null,
등록일 varchar(30) not null,
등록상태 varchar(5) not null,
foreign key(판매자번호) references 판매자(판매자번호),
foreign key(중개인번호) references 부동산중개인(중개인번호)
);

create table 최근거래매물 (
거래번호 int primary key,
매물번호 varchar(10),
구매자번호 int not null,
판매자번호 int not null,
중개인번호 int not null,
판매일 varchar(30) not null,
foreign key(매물번호) references 현재매물(매물번호),
foreign key(구매자번호) references 구매자(구매자번호),
foreign key(판매자번호) references 판매자(판매자번호),
foreign key(중개인번호) references 부동산중개인(중개인번호)
);