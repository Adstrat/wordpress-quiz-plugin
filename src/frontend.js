import React from 'react'
import ReactDOM from 'react-dom'
import "./frontend.scss"

const divsToUpdate = document.querySelectorAll( ".quiz-update-me" )

divsToUpdate.forEach( function ( div ) {
  const data = JSON.parse( div.querySelector( "pre" ).innerHTML )
  ReactDOM.render( <Quiz {...data} />, div )
  div.classList.remove( "quiz-update-me" )
} )

function Quiz( props ) {
  return (
    <div className="quiz-frontend">
      <p>{props.question}</p>
      <ul>
        {props.answers.map( function ( answer ) {
          return <li>{answer}</li>
        } )}
      </ul>
    </div>
  )
}