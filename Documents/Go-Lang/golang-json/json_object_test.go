package golangjson

import (
	"encoding/json"
	"fmt"
	"os"

	// "strconv"
	"testing"
)

type hobi []string

type Address struct {
	City    string
	Country string
}

type Users struct {
	Firstname string
	Lastname  string
	Age       int
	Hobbies   hobi
	Address
}

func TestJSONObject(t *testing.T) {
	users := Users{
		Firstname: "Fauzan",
		Lastname:  "Nurhidayat",
		Age:       23,
	}

	bytes, _ := json.Marshal(users)
	fmt.Println(string(bytes))
}

func TestDecodeJSONObject(t *testing.T) {
	jsonString := `{"Firstname":"Fauzan","Lastname":"Nurhidayat","Age":23}`
	jsonByte := []byte(jsonString)

	users := &Users{}

	err := json.Unmarshal(jsonByte, users)
	if err != nil {
		panic(err)
	}
	fmt.Println(users)
	fmt.Println(users.Firstname)
}

func TestJSONObjectArray(t *testing.T) {
	users := Users{
		Firstname: "Fauzan",
		Lastname:  "Nurhidayat",
		Age:       23,
		Hobbies: []string{
			"Reading",
			"Coding",
			"Gaming",
		},
	}

	bytes, _ := json.Marshal(users)
	fmt.Println(string(bytes))
	fmt.Println(string(bytes))
}

func TestDecodeJSONObjectArray(t *testing.T) {
	jsonString := `{"Firstname":"Fauzan","Lastname":"Nurhidayat","Age":23,"Hobbies":["Reading","Coding","Gaming"]}`
	jsonByte := []byte(jsonString)

	users := &Users{}

	err := json.Unmarshal(jsonByte, users)
	if err != nil {
		panic(err)
	}

	fmt.Println(users.Firstname)
	for _, hobby := range users.Hobbies {
		fmt.Println(hobby)
	}
}

func TestDecodeOnlyJSONObjectArray(t *testing.T) {
	jsonString := `[{"City":"Kebumen","Country":"Indonesia"},{"City":"Cikarang","Country":"Indonesia"}]`
	jsonByte := []byte(jsonString)

	addresses := &[]Address{} // menangkap json array
	err := json.Unmarshal(jsonByte, addresses)
	if err != nil {
		panic(err)
	}

	fmt.Println(addresses)
}

// menggunakan json_tag

type Product struct {
	Id       int64  `json:"id"`
	Name     string `json:"name"`
	Price    int64  `json:"price"`
	ImageURL string `json:"image_url"`
}

func TestJSONTag(t *testing.T) {
	product := Product{
		Id:       1,
		Name:     "Mangga",
		Price:    12000,
		ImageURL: "https://example.com/mangga.png",
	}

	bytes, _ := json.Marshal(product)
	fmt.Println(string(bytes))
	/*  
	hasilnya :
	{
		"id":1,
		"name":"Mangga",
		"price":12000,
		"image_url":"https://example.com/mangga.png"
	}
	*/
}

func TestJSONTagDecode(t *testing.T) {
	jsonString := `{
		"id":1,
		"name":"Mangga",
		"price":12000,
		"image_url":"https://example.com/mangga.png"
	}`
	jsonByte := []byte(jsonString)

	products := &Product{}

	err := json.Unmarshal(jsonByte, products)
	if err != nil {
		panic(err)
	}
	fmt.Println(products)
}

func TestJSONMap(t *testing.T) {
	jsonRequest := `{"id":1,"name":"iPhone 15 Pro Max", "price":12000000}`
	jsonBytes := []byte(jsonRequest)

	var result map[string]interface{}
	_ = json.Unmarshal(jsonBytes, &result)
	fmt.Println(result["id"])
	fmt.Println(result["name"])
	// fmt.Printf("%T",result["price"] )
	var price float64 = result["price"].(float64)
	fmt.Println(int64(price))
}

// mengonversi data dari stream menjadi 
func TestStreamDecoder(t *testing.T) {
	reader, _ := os.Open("Users.json")
	decoder := json.NewDecoder(reader)

	var users Users
	// users := &Users{}
	decoder.Decode(&users)

	fmt.Println(users)
}

// menulis data json ke stream (contohnya file txt)
func TestEncoder(t *testing.T) {
	writer, _ := os.Create("new_user.txt")
	encoder := json.NewEncoder(writer)

	customer := Users{
		Firstname: "Susi",
		Lastname: "Anjar",
		Age: 22,
	}
	encoder.Encode(customer) // memasukkan data json Users ke dalam file new_user.txt
}