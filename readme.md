# Problem Statement
You are expected to build a REST API using Laravel (5.6 or above), which fulfils the functional requirements of a To-do Application. Frontend not required.

As a part of this, you will be expected to complete the following

Writing backend API for the To Do List application.
* Users Should be able to create a Task or Subtask
* Users Should be able to View the list of all the Tasks and Subtasks that are pending. It is fair to assume that tasks will always be sorted based on `due-date` (ascending).
* Users Should be able to mark a Task Complete
* Users Should be able to delete a Task ( Soft Delete )
* Users should be able to filter Tasks based on `due-date` should be possible using the following - Today, This Week, Next Week, Overdue.
* Search (on `title`) should be available.
* All tasks which are soft deleted for more than a month should be permanently deleted from the system.

### Task Properties
* A Task will have a `title` and `due-date`.
* There are only 2 states applicable for a task. Pending or Completed.
* Tasks can have related sub-tasks.

# Technology
* Laravel
* Mysql
* Postman

# Installation
1. Pull the repository
> git clone https://github.com/nfraz007/laravel_coding_assignment.git

2. go inside the repository
> cd laravel_coding_assignment

3. install all the dependency
> composer install

4. copy env file and update the database credential. create a database "laravel_coding_assignment"
> cp .env.example .env

5. run migration command to get all the required tables
> php artisan migrate

6. you are all set. run this command to start this project
> php artisan serve

This will start this project in http://127.0.0.1:8000

# Api Details
I am attaching postman collection for api detail. please download and import in the postman

location: postman_collections/Laravel Coding Assignment.postman_collection.json

in collection i have added example as well. 

# Additional Command
I have create a custom command which will delete all the soft deleted data which has deleleted date more than 1 month. to run that command
> php artisan delete_old_data

# Samples

* Get all todos after applying filter
```json
{
    "status": 200,
    "message": "Success",
    "data": {
        "todos": [
            {
                "id": 4,
                "parent_id": 1,
                "title": "this is another title",
                "status": 0,
                "due_date": "2021-01-04 00:00:00",
                "created_at": "2021-01-14 07:32:15",
                "updated_at": null,
                "status_label": {
                    "label": "Pending",
                    "color": "success"
                }
            },
            {
                "id": 8,
                "parent_id": 1,
                "title": "this is another title",
                "status": 0,
                "due_date": "2021-01-14 00:00:00",
                "created_at": "2021-01-14 08:00:31",
                "updated_at": null,
                "status_label": {
                    "label": "Pending",
                    "color": "success"
                }
            },
            {
                "id": 9,
                "parent_id": 1,
                "title": "this is another title",
                "status": 0,
                "due_date": "2021-01-14 00:00:00",
                "created_at": "2021-01-14 08:00:34",
                "updated_at": null,
                "status_label": {
                    "label": "Pending",
                    "color": "success"
                }
            },
            {
                "id": 10,
                "parent_id": 1,
                "title": "this is another title",
                "status": 0,
                "due_date": "2021-01-19 00:00:00",
                "created_at": "2021-01-14 08:04:24",
                "updated_at": null,
                "status_label": {
                    "label": "Pending",
                    "color": "success"
                }
            },
            {
                "id": 7,
                "parent_id": 1,
                "title": "this is another title",
                "status": 0,
                "due_date": "2021-01-27 00:00:00",
                "created_at": "2021-01-14 07:47:24",
                "updated_at": null,
                "status_label": {
                    "label": "Pending",
                    "color": "success"
                }
            },
            {
                "id": 1,
                "parent_id": 0,
                "title": "this is another title",
                "status": 0,
                "due_date": "2021-01-30 00:00:00",
                "created_at": "2021-01-14 07:22:15",
                "updated_at": null,
                "status_label": {
                    "label": "Pending",
                    "color": "success"
                }
            },
            {
                "id": 5,
                "parent_id": 1,
                "title": "this is another title",
                "status": 0,
                "due_date": "2021-01-30 00:00:00",
                "created_at": "2021-01-14 07:46:15",
                "updated_at": null,
                "status_label": {
                    "label": "Pending",
                    "color": "success"
                }
            }
        ]
    }
}
```

* Get a single todo
```json
{
    "status": 200,
    "message": "Successfully get the data.",
    "data": {
        "todo": {
            "id": 1,
            "parent_id": 0,
            "title": "this is another title",
            "status": 0,
            "due_date": "2021-01-30 00:00:00",
            "created_at": "2021-01-14 07:22:15",
            "updated_at": null,
            "status_label": {
                "label": "Pending",
                "color": "success"
            }
        }
    }
}
```

* Create a new todo
```json
{
    "status": 200,
    "message": "Successfully created.",
    "data": {
        "todo_id": 10
    }
}
```

* Update a todo
```json
{
    "status": 200,
    "message": "Successfully updated.",
    "data": []
}
```

* Delete a todo
```json
{
    "status": 200,
    "message": "Successfully deleted.",
    "data": []
}
```