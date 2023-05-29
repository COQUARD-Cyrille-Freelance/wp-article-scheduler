/**
 * @typedef {import('@roots/bud').Bud} Bud
 *
 * @param {Bud} bud
 */
module.exports = async bud => {
	bud.externals(
		{
			jQuery: 'window.jquery',
			wp: 'window.wp',
			react: 'window.React'
	    }
        )
	await bud
		.setPath( '@dist', '../assets' )
		.proxy(new URL(`http://localhost:8888`))
		.entry(
			{
				app: 'app.js',
		}
			)
		.when( bud.isProduction, () => bud.splitChunks().minimize() )
}
