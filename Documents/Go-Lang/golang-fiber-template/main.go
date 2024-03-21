package main

import "github.com/gofiber/fiber/v3"

func main() {
	app := fiber.New();

	err := app.Listen("localhost:8000")
	if err != nil {
		panic(err)
	}
}