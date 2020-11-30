# sample-project-1 API

REST API to provide access to sensor readings from devices.

## API

The API is defined using OpenAPI 3.0. See [swagger.yaml](https://github.com/buffaloiot/sample-project-1/blob/master/api/src/definition/swagger.yaml).
For more info on OpenAPI  see (https://swagger.io/).

The API was originally implemented as an express app written in typescript in [https://github.com/buffaloiot/sample-project-1/]. Here reimplemented in PHP in apache2 as an exercise.

Makefile has the targets necessary to build the Docker image.

- `make image`   creates docker image

The image has been pushed to dockerhub.

```
docker pull rcolbey/sample-api-1:php
```
