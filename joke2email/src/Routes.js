import React from 'react'
import { Routes as Router, Route } from 'react-router-dom'
import HomePage from './home/Home'

export default function Routes() {
	return (
		<Router>
			<Route path="/" element={<HomePage />} />
		</Router>
	)
}
