import React, { Component } from "react";
import { getMovies } from "./getMovies";


class Solution extends Component {
  constructor(props) {
    super(props);
    this.handleChange = this.handleChange.bind(this);
    this.handleSwitch = this.handleSwitch.bind(this);
  }
  state = {
    allDrugs: getMovies(),
    allGenres: [],
    drugPrice: 0,
    searchDrug: []
  };

  handleChange = e => {
    let allDrugs = [...this.state.allDrugs];
    let theDrug = allDrugs.find(drug => drug.title === e.target.value);
    if (theDrug) {
      this.setState({ allGenres: theDrug.genre });
      this.setState({ drugPrice: 0 });
      const second = document.querySelector("#switch");
      second.value = "";
    } else {
      this.setState({ allGenres: [] });
      const second = document.querySelector("#switch");
      second.value = "";
      this.setState({ drugPrice: 0 });
    }
  };
  handleSwitch = e => {
    let allGenres = [...this.state.allGenres];
    let theDrug = allGenres.find(drug => drug.title === e.target.value);
    if (theDrug) {
      this.setState({ drugPrice: theDrug.price });
    } else {
      this.setState({ drugPrice: 0 });
    }
  };

  render() {
    return (
      <React.Fragment>
        <div>
          Name
          <select onChange={this.handleChange}>
            <option value="">Please Select</option>
            {this.state.allDrugs.map(drug => (
              <option>{drug.title}</option>
            ))}
          </select>
          Genres
          <select id="switch" onChange={this.handleSwitch}>
            <option value="">Please Select</option>
            {this.state.allGenres.map(drug => (
              <option>{drug.title}</option>
            ))}
          </select>
          price: <input type="text" value={this.state.drugPrice} />
        </div>
      </React.Fragment>
    );
  }
}

export default Solution;
