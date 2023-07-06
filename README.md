# Welcome to the Grievance Redress System (Backend)

- [Authors](#authors)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Developer Guide](#developer-guide)
- [Contributions and Support](#contributions-and-support)
- [License](#license)

## Authors

- [@Biplob](https://www.linkedin.com/in/ekramul-kabir-biplob/)
- [@Tappware Solutions Limited](https://tappware.com/)


## Prerequisites

Before proceeding with the installation, make sure you have the following software installed on your system:

- PHP (version 8.0 or higher)
- Composer


## Installation

```sh
git clone this-url
```

```sh
cd project-root
```

##### Install [composer](https://getcomposer.org/) dependencies of this project by running

```sh
composer install
```

##### Copy `.env-example` to `.env` and download database from [database/test-db](https://github.com/GRS-DPG/GRS-API/tree/master/database/test-db) folder and configure your database and other connection.


##### Run this command to clear all type of cache

```shell
php artisan cache:clear
```

```shell
php artisan optimize:clear
```


##### Run this command to start application

```shell
php artisan serve
```


## Usage

Api Url `http://127.0.0.1:8000` and go to the link `http://127.0.0.1:5173/` for login and enter the system admin credentials below.

##### Demo complianant credentials

```shell
mobile no: 01756888319
password: 123456
```

##### Demo system admin credentials

```shell
user id: 200000000163
password: 02522016
```

##### Demo gro officer credentials

```shell
user id: 100000006843
password: 02522016
```

##### Demo appeal officer credentials

```shell
user id: 100000004769
password: 02522016
```



## Developer Guide

### Basic Instruction

- All model should extend BaseModel class.
- All controller should extend BaseController class.


## Contributions and Support

Thanks to [everyone](https://github.com/a2i-dpg/skills-and-certification/graphs/contributors)
who has contributed to this project!

Please see [CONTRIBUTING.md](CONTRIBUTING.md) to contribute.

If you found any bugs, Please report it using [Github](https://github.com/a2i-dpg/skills-and-certification/issues)

## License

Copyright 2023 @a2i, Bangladesh

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
