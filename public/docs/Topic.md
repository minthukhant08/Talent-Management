# Topic Feature
The endpoint controls Topics.

# Retrieve the list of topics [/v1/topics]

### GET

+ Parameters
    + limit : `30` (optional, integer)
    + offset : `0` (optional, integer)

Retrieve the list of topics.


+ Response 200 (application/json; charset=utf-8)

    + Body

            {
              "success": 1,
              "code": 200,
              "meta": {
                  "method": "GET",
                  "endpoint": "api/v1/topics",
                  "limit": 30,
                  "offset": 0,
                  "total": 40
              },
              "data": [
                  {
                      "id": 14,
                      "topic": "culpa",
                      "descriptions": "Consequatur corporis repellat dolor atque quia fugiat. Ipsa amet repellat ut quia sequi doloremque fugiat. Ut officiis amet mollitia. Aut et sapiente ipsam et libero qui ut.",
                      "start_date": "2013-12-07",
                      "end_date": "1992-03-24",
                      "detail": []
                  },
                  {
                      "id": 15,
                      "topic": "laboriosam",
                      "descriptions": "Doloribus nulla deleniti explicabo quae unde excepturi. Est hic recusandae qui optio explicabo. Adipisci error necessitatibus corrupti omnis ut est similique sed.",
                      "start_date": "1979-07-01",
                      "end_date": "1971-01-27",
                      "detail": []
                  },
                  {
                      "id": 16,
                      "topic": "unde",
                      "descriptions": "Ea aperiam eum vitae porro aliquid consequuntur. Quos rerum et enim voluptas perferendis. Earum aut et ut et recusandae velit aut libero.",
                      "start_date": "2002-07-16",
                      "end_date": "2003-12-04",
                      "detail": [
                          {
                              "id": 5,
                              "name": "Lawrence Daugherty",
                              "descriptions": "Iusto dolorem est voluptatum iure.",
                              "date": "1984-10-01",
                              "teacher": {
                                  "name": "Dr. Mark Effertz V",
                                  "id": 1,
                                  "image": "https://vuetifyjs.com/apple-touch-icon-180x180.png"
                              }
                          }
                      ]
                  }
              ],
              "errors": {},
              "duration": 0.218
          }


### GET

## Retrieve a specific Topic [/v1/topics/:id]

 Retrieve a specific topic.

### GET

+ Parameter
    + id: `1` (required, integer) - To filter by specific topic id.


+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 201,
                "meta": {
                    "method": "GET",
                    "endpoint": "api/v1/topics/1",
                    "limit": 30,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 1,
                        "topic": "aut",
                        "descriptions": "Debitis suscipit aut vero sed sed repudiandae. Dignissimos sit iste quod aut omnis. Suscipit aut illo et optio. Velit voluptatem odio tempora et quaerat eligendi.",
                        "start_date": "1983-02-18",
                        "end_date": "1992-06-21",
                        "detail": [
                            {
                                "id": 8,
                                "name": "Shanna Zemlak",
                                "descriptions": "Asperiores corporis a repellat rerum quo facilis quibusdam.",
                                "date": "1990-04-09",
                                "teacher": {
                                    "name": "Elroy Gaylord",
                                    "id": 1,
                                    "image": "http://schinner.com/aliquid-magni-ea-distinctio"
                                }
                            },
                            {
                                "id": 9,
                                "name": "Shanna Zemlak",
                                "descriptions": "Asperiores corporis a repellat rerum quo facilis quibusdam.",
                                "date": "1990-04-09",
                                "teacher": {
                                    "name": "Elroy Gaylord",
                                    "id": 1,
                                    "image": "http://schinner.com/aliquid-magni-ea-distinctio"
                                }
                            }
                        ]
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
                    "endpoint": "api/v1/topic/155",
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



## Creates a Topic [/v1/topics]

Creates a Topic.

### POST
+ Parameters
    + id: `1` (required, integer).
    + topic: `Front End` (required, string).
    + descriptions: `some paragraph`  (required, string).
    + start_date: `1971-11-15` (required, date).
    + end_date: `1971-11-15` (required, date).

+ Response 201 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 201,
                "meta": {
                    "method": "POST",
                    "endpoint": "api/v1/topics",
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
                    "endpoint": "api/v1/topics",
                    "limit": 30,
                    "offset": 0
                },
                "data": [],
                "errors": {
                    "message": "The request parameters are incorrect, please make sure to follow the documentation.",
                    "code": 400002,
                    "validation": [
                          {
                              "attribue": "course_id",
                              "message": "The course id field is required."
                          },
                          {
                              "attribue": "course_id",
                              "message": "The selected course id is invalid."
                          },
                          {
                              "attribue": "topic",
                              "message": "The topic field is required."
                          },
                          {
                              "attribue": "descriptions",
                              "message": "The descriptions field is required."
                          }
                    ]
                },
                "duration": 0.263
            }

## Updates a Topic [/v1/topics/:id]

  Updates a detail of topic that correspond to the ID as the last segment of the URL.

### PUT

  + Parameter
    + id:`1` (required, string). - To filter by specific topic id.
    + topic: `Back End` (optional, string).
    + descriptons: `some paragraph` (optional, string).
    + course_id: `1` (optional, integer).
    + start_date: `1971-11-15` (optional, date).
    + end_date: `1971-11-15` (optional, date).


  + Response 201 (application/json; charset=utf-8)

      + Body

            {
                "success": 1,
                "code": 200,
                "meta": {
                    "method": "PUT",
                    "endpoint": "api/v1/topics/1",
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
                            "attribue": "course_id",
                            "message": "The selected course id is invalid."
                        }
                    ]
                },
                "duration": 0.055
            }


## Deletes a Topic [/v1/topics/:id]

  Deletes a topic that correspond to the ID as the last segment of the URL.

### DELETE

+ Parameter
    + id: `1` (required, integer) - A primary key of topic id.


+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 200,
                "meta": {
                    "method": "DELETE",
                    "endpoint": "api/v1/topics/1",
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
                    "endpoint": "api/v1/topics/178",
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
