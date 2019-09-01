# Topic detail Feature
The endpoint controls Topic Details.

# Retrieve the list of topic details [/v1/topicsdetails]

### GET

+ Parameters
    + limit : `30` (optional, integer)
    + offset : `0` (optional, integer)

Retrieve the list of topic details.


+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 200,
                "meta": {
                    "method": "GET",
                    "endpoint": "api/v1/topicdetailss",
                    "limit": 30,
                    "offset": 0,
                    "total": 40
                },
                "data": [
                    {
                        "id": 12,
                        "name": "Angelina Quitzon",
                        "descriptions": "Et voluptatibus et veniam voluptatem eligendi qui.",
                        "date": "1995-01-01",
                        "teacher": {
                            "name": "Horacio Kub",
                            "id": 1,
                            "image": "https://vuetifyjs.com/apple-touch-icon-180x180.png"
                        }
                    },
                    {
                        "id": 13,
                        "name": "Dr. Freddy Leuschke",
                        "descriptions": "Repellat dolore suscipit id tenetur dolorum.",
                        "date": "2013-10-31",
                        "teacher": {
                            "name": "Horacio Kub",
                            "id": 1,
                            "image": "https://vuetifyjs.com/apple-touch-icon-180x180.png"
                        }
                    },
                ],
                "errors": {},
                "duration": 0.218
          }


### GET

## Retrieve a specific Topic Detail [/v1/topicdetails/:id]

 Retrieve a specific topic detail.

### GET

+ Parameter
    + id: `1` (required, integer) - To filter by specific topic detail id.


+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 201,
                "meta": {
                    "method": "GET",
                    "endpoint": "api/v1/topicdetails/1",
                    "limit": 30,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 1,
                        "name": "Juvenal Corkery",
                        "descriptions": "Voluptatem fuga explicabo quis ut officiis quasi autem quaerat.",
                        "date": "1992-01-11",
                        "teacher": {
                            "name": "Horacio Kub",
                            "id": 1,
                            "image": "https://vuetifyjs.com/apple-touch-icon-180x180.png"
                        }
                    }
                ],
                "errors": {},
                "duration": 0.079
              }

+ Response 404 (application/json; charset=utf-8)

    + Body

            {
                "success": 0,
                "code": 404,
                "meta": {
                    "method": "GET",
                    "endpoint": "api/v1/topicdetails/155",
                    "limit": 30,
                    "offset": 0
                },
                "data": [],
                "errors": {
                  "message": "The resource that match ID: ( 155 ) does not found.",
                  "code": 400001
                },
                "duration": 0.079
            }



## Creates a Topic Detail [/v1/topicdetails]

Creates a Topic.

### POST
+ Parameters
    + id: `1` (required, integer).
    + name: `HTML` (required, string).
    + descriptions: `some paragraph`  (required, string).
    + date: `1971-11-15` (required, date).
    + teacher_id: `1` (required, teacher id).
    + topic_id: `5` (required, topic id).

+ Response 201 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 201,
                "meta": {
                    "method": "POST",
                    "endpoint": "api/v1/topicdetails",
                    "limit": 30,
                    "offset": 0
                },
                "data": {
                    "id": 11
                },
                "errors": {},
                "duration": 0.063
            }


+ Response 400 (application/json; charset=utf-8)

    + Body

            {
                "success": 0,
                "code": 400,
                "meta": {
                    "method": "POST",
                    "endpoint": "api/v1/topicdetails",
                    "limit": 30,
                    "offset": 0
                },
                "data": [],
                "errors": {
                    "message": "The request parameters are incorrect, please make sure to follow the documentation.",
                    "code": 400002,
                    "validation": [
                          {
                              "attribue": "topic_id",
                              "message": "The topic id field is required."
                          },
                          {
                              "attribue": "name",
                              "message": "The name field is required."
                          },
                          {
                              "attribue": "descriptions",
                              "message": "The descriptions field is required."
                          },
                          {
                              "attribue": "date",
                              "message": "The date field is required."
                          },
                          {
                              "attribue": "teacher_id",
                              "message": "The teacher id field is required."
                          },
                          {
                              "attribue": "course_id",
                              "message": "The selected course id is invalid."
                          },
                          {
                              "attribue": "teacher_id",
                              "message": "The selected teacher id is invalid."
                          },

                          {
                              "attribue": "descriptions",
                              "message": "The descriptions field is required."
                          },
                          {
                               "attribue": "date",
                               "message": "The date is not a valid date."
                          }
                    ]
                },
                "duration": 0.263
            }

## Updates a Topic Detail [/v1/topicdetails/:id]

  Updates a detail of topic detail that correspond to the ID as the last segment of the URL.

### PUT

  + Parameter
    + id: `1` (required, integer).
    + name: `HTML` (optional, string).
    + descriptions: `some paragraph`  (optional, string).
    + date: `1971-11-15` (optional, date).
    + teacher_id: `1` (optional, teacher id).
    + topic_id: `5` (optional, topic id).


  + Response 201 (application/json; charset=utf-8)

      + Body

            {
                "success": 1,
                "code": 200,
                "meta": {
                    "method": "PUT",
                    "endpoint": "api/v1/topicdetails/1",
                    "limit": 30,
                    "offset": 0
                },
                "data": {
                    "updated": 1
                },
                "errors": {},
                "duration": 0.057
            }


+ Response 400 (application/json; charset=utf-8)

    + Body

            {
                "success": 0,
                "code": 400,
                "meta": {
                    "method": "PUT",
                    "endpoint": "api/v1/topics/1",
                    "limit": 30,
                    "offset": 0
                },
                "data": [],
                "errors": {
                    "message": "The request parameters are incorrect, please make sure to follow the documentation.",
                    "code": 400002,
                    "validation": [
                        {
                            "attribue": "topic_id",
                            "message": "The selected topic id is invalid."
                        },
                        {
                             "attribue": "date",
                             "message": "The date is not a valid date."
                        },
                        {
                             "attribue": "teacher_id",
                             "message": "The teacher id is invalid"
                        }
                    ]
                },
                "duration": 0.055
            }


## Deletes a Topic [/v1/topicdetails/:id]

  Deletes a topic detail that correspond to the ID as the last segment of the URL.

### DELETE

+ Parameter
    + id: `1` (required, integer) - A primary key of topic detail id.


+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 200,
                "meta": {
                    "method": "DELETE",
                    "endpoint": "api/v1/topicdetails/1",
                    "limit": 30,
                    "offset": 0
                },
                "data": {
                    "deleted": 1
                },
                "errors": {},
                "duration": 0.054
            }

+ Response 404 (application/json; charset=utf-8)

    + Body

            {
                "success": 0,
                "code": 404,
                "meta": {
                    "method": "DELETE",
                    "endpoint": "api/v1/topicdetails/178",
                    "limit": 30,
                    "offset": 0
                },
                "data": [],
                "errors": {
                    "message": "The resource that match ID: ( 178 ) does not found.",
                    "code": 400001
                    },
                "duration": 0.054
            }
