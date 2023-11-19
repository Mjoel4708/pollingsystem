# Polling System

## Introduction

This is a Polling System designed to facilitate the creation, management, and participation in polls. It allows users to create polls, add questions, and make choices. Additionally, users can vote and view real-time updates on the poll results.

## Technologies Used

- Laravel: A PHP web application framework
- Pusher: A real-time communication service
- MySQL: Database for storing data
- JavaScript: Used for dynamic and interactive components
- Vue.js: JavaScript framework for building user interfaces

## System Architecture

The system follows a Model-View-Controller (MVC) architecture, a widely used design pattern in web development.

### Models

- **Poll**: Represents a poll with attributes like title, description, and owner.
- **Question**: Represents a question associated with a poll.
- **Choice**: Represents choices associated with a question.
- **Vote**: Represents user votes for a specific choice.

### Controllers

- **PollController**: Handles actions related to polls, including creating, updating, and deleting.
- **QuestionController**: Manages questions, such as creating, updating, and deleting.
- **ChoiceController**: Handles actions related to choices, like creating and updating.
- **VoteController**: Manages user votes, including voting, unvoting, and displaying votes.

### Services

#### PollService
Encapsulates business logic related to polls.

#### QuestionService
Encapsulates business logic related to questions.

#### ChoiceService
Encapsulates business logic related to choices.

#### VoteService
Encapsulates business logic related to votes.

### Repositories

#### PollRepository
Handles database interactions for polls.

#### QuestionRepository
Handles database interactions for questions.

#### ChoiceRepository
Handles database interactions for choices.

#### VoteRepository
Handles database interactions for votes.



### Views

- Blade templates: Used for server-side rendering of HTML pages.

## How to Run

### Prerequisites

- PHP (>= 8.0)
- Composer
- Node.js
- MySQL
- Pusher account (for real-time updates)

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/polling-system.git
    ```
2. Install dependencies:

   ```bash
   composer install
   ```
3. Create a database and update the `.env` file with the database credentials.
4. Create a Pusher account and update the `.env` file with the Pusher credentials.
5. Run the migrations:

   ```bash
   php artisan migrate
   ```
6. Run the server:

   ```bash
    php artisan serve
    ```
7. Generate the application key:

   ```bash
   php artisan key:generate
   ```
   
8. Run the application:

   ```bash
   php artisan serve
   ```

### Author
- [Michael Orwa](https://github.com/mjoel4708)


