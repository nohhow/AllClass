# AllClass : 모두의 클래스
모든 교수자<->학습자를 위한 웹 서비스 (마치 Google Classroom)

## 개요
- 4학년 1학기 모바일 프로그래밍 기말 프로젝트로 진행
- 팀(2인) 프로젝트 : 기능별 역할 분담
- 자유주제였는데, 언택트 시대에 학생들 간 스터디나 학교, 학원 등 교육 상황에서 활용할 수 있는 교육용 웹 서비스 개발을 해보고자 했다.

## 이미지
|화면캡처||||
|--|--|--|--|
|<img width="500" alt="class-1" src="https://user-images.githubusercontent.com/61059893/159923650-022aa76f-92fd-4ac1-87bd-562b82e95eb9.png">|<img width="500" alt="class-4" src="https://user-images.githubusercontent.com/61059893/159923711-1c0322fb-5474-435b-adc8-11d0b799c7e0.png">|<img width="500" alt="class-5" src="https://user-images.githubusercontent.com/61059893/159923746-abc511b0-0146-464e-b84e-5889d2682690.png">|<img width="500" alt="class-5" src="https://user-images.githubusercontent.com/61059893/159923822-adb377f1-44db-4896-b768-2c9a3fe36470.png">|<img width="500" alt="class-2" src="https://user-images.githubusercontent.com/61059893/159923660-c579d9ec-2c88-436d-8a20-39e88ab9ece1.png">|

## 기술 스택
- HTML, CSS, Javascript
- PHP, Apache, MySQL
- AWS

## 기능 소개
1. 온라인 학습소통 공간(클래스룸) 제공
  - 공지사항, 자유게시판, 질문게시판, 과제게시판 등
  - 댓글, 답글 작성
2. 클래스룸 생성 및 가입, 가입 관리 등
3. 회원가입 및 로그인 (이메일 인증)

## 배운 점
- 기능 설계, 데이터베이스 설계 경험
- Bootstrap 라이브러리를 일부 활용해서 작성
- AWS EC2를 활용한 웹서버 개발 경험


## 부족한 점
- 데이터베이스의 관계를 이용해서 더 효율적이거나 간소화하게 작성할 수도 있을 것 같은데 필요한 만큼 table을 구성한 점
- 회원 가입은 있지만 탈퇴가 없다.
- 동영상/스트리밍 게시판의 부재
- css 우선적용 순서를 고려하지 않고 inline, Bootstrap 등 닥치는 대로 작성하여 통일성이 없음 -> 유지보수 어려움
