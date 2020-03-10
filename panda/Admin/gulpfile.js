const {
	src,
	dest,
	parallel,
	series
} = require("gulp")

// Requires
const watch = require("gulp-watch")
const sass = require("gulp-sass")
const bulkSass = require("organizze-gulp-sass-bulk-import")
const autoprefixer = require("gulp-autoprefixer")
const postcss = require("gulp-postcss")
const emMediaQuery = require("postcss-em-media-query")
const concat = require("gulp-concat")
const uglify = require("gulp-uglify")
const plumber = require("gulp-plumber")
const pxtorem = require("postcss-pxtorem")
const babel = require("gulp-babel")
const sourcemaps = require("gulp-sourcemaps")
const cssnano = require("cssnano")
const touch = require("gulp-touch-cmd")
const clip = require("gulp-clip-empty-files")
const include = require("gulp-include")
const cssImport = require("gulp-cssimport")

//* --- Paths  ---------------------------

const path = {
	src: "Src/",
	build: "Build/",
	components: "Components/",
	nodeModules: "node_modules/"
}

const bundleScripts = [
	path.build + "vendors.js",
	path.build + "extraAdmin.js",
]


//* --- Functions ---------------------------


//* --- Tasks ---------------------------

function scripts() {
	return src([path.components + "**/*.js"])
		.pipe(sourcemaps.init())
		.pipe(plumber())
		.pipe(clip())
		.pipe(concat("extraAdmin.js"))
		.pipe(babel({
			presets: ['@babel/env'],
			plugins: ["@babel/plugin-proposal-class-properties"]
		}))
		.pipe(sourcemaps.write("."))
		.pipe(dest(path.build))
		.pipe(touch())
}
exports.scripts = scripts

function scriptsVendors() {

	return src(path.src + "vendors.js")
		.pipe(plumber())
		.pipe(include())
		.pipe(dest(path.build))

}
exports.scriptsVendors = scriptsVendors

function scriptsBundle() {

	return src(bundleScripts)
		.pipe(sourcemaps.init())
		.pipe(plumber())
		.pipe(clip())
		.pipe(concat("extraAdminBundle.js"))
		.pipe(uglify())
		.pipe(sourcemaps.write("."))
		.pipe(dest(path.build))
		.pipe(touch())

}
exports.scriptsBundle = scriptsBundle


function css() {

	return src(path.src + "extraAdmin.scss")
		.pipe(plumber())
		.pipe(bulkSass())
		.pipe(cssImport())
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				outputStyle: "expanded"
			})
		)
		.pipe(autoprefixer({
			overrideBrowserslist: [
				"> 1%",
				"last 2 versions",
				"IE 11"
			]
		}))
		.pipe(
			postcss([
				emMediaQuery({
					precision: 3
				}),
				cssnano(),
				pxtorem({
					rootValue: 16,
					propList: ['*'],
					selectorBlackList: [/^body$/]
				})
			])
		)
		.pipe(sourcemaps.write("."))
		.pipe(dest(path.build))
		.pipe(touch())
}
exports.css = css


function watchAdminFiles() {

	watch([path.components + "**/*.scss", path.src + "*.scss"], css)
	watch(path.components + "**/*.js", series(scripts, scriptsBundle))
	watch(path.src + "vendors.js", series(scriptsVendors, scriptsBundle))

}
exports.watchAdminFiles = watchAdminFiles


//* --- Complex tasks ---------------------------


const buildJs = parallel(scripts, scriptsVendors)
exports.buildJs = buildJs

const buildBundleJs = series(buildJs, scriptsBundle)
exports.buildBundleJs = buildBundleJs

const buildAdmin = parallel(css, buildBundleJs)
exports.buildAdmin = buildAdmin

const watchAdmin = series(buildAdmin, watchAdminFiles)
exports.watchAdmin = watchAdmin

exports.default = watchAdmin