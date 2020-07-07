/**
 * To start - gulp
 *
 * UsefulTasks:
 * Build all one time - gulp buildAdmin
 *
 */

const {
	src,
	dest,
	parallel,
	series
} = require("gulp")

// Requires

// --- Gulp

// ------ Basic
const watch = require("gulp-watch")
const plumber = require("gulp-plumber")
const sourcemaps = require("gulp-sourcemaps")
const touch = require("gulp-touch-cmd")
const clip = require("gulp-clip-empty-files")

// ------ CSS related
const sass = require("gulp-sass")
const bulkSass = require("organizze-gulp-sass-bulk-import")
const postcss = require("gulp-postcss")
const cssnano = require("cssnano")
const cssImport = require("postcss-import")
const pxtorem = require("postcss-pxtorem")
const autoprefixer = require("gulp-autoprefixer")

// ------------ postcss plugins
const emMediaQuery = require("postcss-em-media-query")

// ------ JavaScript related
const concat = require("gulp-concat")
const uglify = require("gulp-uglify")
const babel = require("gulp-babel")
const include = require("gulp-include")


//* --- Paths  ---------------------------

// Roots
const srcRoot = "Src/"
const buildRoot = "Build/"
const nodeModulesRoot = "node_modules/"

// Paths

const srcPaths = {
	Scss: srcRoot + "Scss/",
	Scripts: srcRoot + "Js/",
	Components: srcRoot + "Components/",
}

const buildPaths = {
	Styles: buildRoot,
	Scripts: buildRoot,
}

const Settings = {
	sass: {
		outputStyle: "expanded",
		includePaths: [
			nodeModulesRoot,
			srcPaths.Scss,
			srcPaths.Components,
		],
	},
	autoprefixer: {
		overrideBrowserslist: [
			"> 1%",
			"last 2 versions",
			"IE 11"
		]
	},
	emMediaQuery: {
		precision: 3
	},
	pxtorem: {
		rootValue: 16,
		propList: ['*'],
		selectorBlackList: [/^body$/]
	},
	babel: {
		presets: ['@babel/env'],
		plugins: ["@babel/plugin-proposal-class-properties"]
	},
	include: {
		includePaths: [nodeModulesRoot]
	},

}

const Globs = {
	ScriptsSrc: [
		srcPaths.Components + "**/*.js",
		srcPaths.Scripts + "*.js",
		"!" + srcPaths.Scripts + "vendors.js"
	],
	ScriptsBundle: buildPaths.Scripts + "{vendors.js,extraAdmin.js}",
	ScriptsVendors: srcPaths.Scripts + "vendors.js",

	Scss: [srcPaths.Components + "**/*.scss", srcPaths.Scss + "**/*.scss"],
}



//* --- Functions ---------------------------


//* --- Tasks ---------------------------

function scripts() {
	return src(Globs.ScriptsSrc)
		.pipe(sourcemaps.init())
		.pipe(plumber())
		.pipe(clip())
		.pipe(concat("extraAdmin.js"))
		.pipe(babel(Settings.babel))
		.pipe(sourcemaps.write("."))
		.pipe(dest(buildPaths.Scripts))
		.pipe(touch())
}
exports.scripts = scripts

function scriptsVendors() {

	return src(Globs.ScriptsVendors)
		.pipe(plumber())
		.pipe(include(Settings.include))
		.pipe(dest(buildPaths.Scripts))

}
exports.scriptsVendors = scriptsVendors

function scriptsBundle() {

	return src(Globs.ScriptsBundle)
		.pipe(sourcemaps.init())
		.pipe(plumber())
		.pipe(clip())
		.pipe(concat("extraAdminBundle.js"))
		.pipe(uglify())
		.pipe(sourcemaps.write("."))
		.pipe(dest(buildPaths.Scripts))
		.pipe(touch())

}
exports.scriptsBundle = scriptsBundle


function css() {
	return src(srcPaths.Scss + "extraAdmin.scss")
		.pipe(plumber())
		.pipe(bulkSass())
		.pipe(sourcemaps.init())
		.pipe(sass(Settings.sass))
		.pipe(autoprefixer(Settings.autoprefixer))
		.pipe(
			postcss([
				emMediaQuery(Settings.emMediaQuery),
				cssImport(),
				cssnano(),
				pxtorem(Settings.pxtorem)
			])
		)
		.pipe(sourcemaps.write("."))
		.pipe(dest(buildPaths.Styles))
		.pipe(touch())
}
exports.css = css


function watchAdminFiles() {

	watch(Globs.Scss, css)
	watch(Globs.ScriptsSrc, series(scripts, scriptsBundle))
	watch(Globs.ScriptsVendors, series(scriptsVendors, scriptsBundle))

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