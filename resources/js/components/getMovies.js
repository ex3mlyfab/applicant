const movies = [
  {
    _id: "5b21ca3eeb7f6fbccd471815",
    title: "Terminator",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 6,
    dailyRentalRate: 2.5,
    publishDate: "2018-01-03T19:04:28.809Z",
    like: true
  },
  {
    _id: "5b21ca3eeb7f6fbccd471816",
    title: "Die Hard",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 5,
    dailyRentalRate: 2.5
  },
  {
    _id: "5b21ca3eeb7f6fbccd471817",
    title: "Get Out",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 8,
    dailyRentalRate: 3.5
  },
  {
    _id: "5b21ca3eeb7f6fbccd471819",
    title: "Trip to Italy",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 7,
    dailyRentalRate: 3.5
  },
  {
    _id: "5b21ca3eeb7f6fbccd47181a",
    title: "Airplane",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 7,
    dailyRentalRate: 3.5
  },
  {
    _id: "5b21ca3eeb7f6fbccd47181b",
    title: "Wedding Crashers",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 7,
    dailyRentalRate: 3.5
  },
  {
    _id: "5b21ca3eeb7f6fbccd47181e",
    title: "Gone Girl",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 7,
    dailyRentalRate: 4.5
  },
  {
    _id: "5b21ca3eeb7f6fbccd47181f",
    title: "The Sixth Sense",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 4,
    dailyRentalRate: 3.5
  },
  {
    _id: "5b21ca3eeb7f6fbccd471821",
    title: "The Avengers",
    genre: [{title: "damilare", price: 730}, {title: "damare", price: 710}],
    price: 7,
    dailyRentalRate: 3.5
  }
];

export function getMovies() {
  return movies;
}
